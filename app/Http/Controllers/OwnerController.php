<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bill;
use App\Models\Ticket;

class OwnerController extends Controller
{
    public function dashboard()
    {
        // Actual Financial Metrics
        $income = Bill::where('status', 'paid')->sum('amount');

        $unpaidRent = Bill::where('status', 'unpaid')->count();
        $unpaidAmount = Bill::where('status', 'unpaid')->sum('amount');

        $totalRooms = \App\Models\Room::count();
        $occupiedRooms = \App\Models\Room::where('status', 'occupied')->count();

        // Calculate Occupancy Rate securely to avoid division by zero
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100) : 0;

        $pendingApprovals = Ticket::with('room', 'user')
            ->whereNotNull('cost')
            ->where('approval_status', 'pending')
            ->latest()
            ->get();

        return view('owner.dashboard', compact('income', 'unpaidRent', 'unpaidAmount', 'totalRooms', 'occupiedRooms', 'occupancyRate', 'pendingApprovals'));
    }

    public function reports(\Illuminate\Http\Request $request)
    {
        $queryBills = Bill::with('lease.room', 'lease.user')->where('status', 'paid');
        $queryExpenses = \App\Models\Expense::query();

        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        if ($request->filled('month')) {
            $queryBills->whereMonth('paid_at', $month);
            $queryExpenses->whereMonth('expense_date', $month);
        }
        if ($request->filled('year')) {
            $queryBills->whereYear('paid_at', $year);
            $queryExpenses->whereYear('expense_date', $year);
        }

        $paidBills = $queryBills->latest('paid_at')->get();
        $expenses = $queryExpenses->latest('expense_date')->get();

        $totalRentIncome = $paidBills->where('type', 'rent')->sum('amount');
        $totalElectricityIncome = $paidBills->where('type', 'electricity')->sum('amount');
        $totalWifiIncome = $paidBills->where('type', 'wifi')->sum('amount'); // If wifi billing exists
        $totalIncome = $paidBills->sum('amount');
        $totalExpense = $expenses->sum('amount');
        $netProfit = $totalIncome - $totalExpense;

        return view('owner.reports.index', compact(
            'paidBills', 'expenses', 'totalIncome', 'totalRentIncome', 'totalElectricityIncome', 'totalWifiIncome', 'totalExpense', 'netProfit', 'month', 'year'
        ));
    }

    public function approveTicket(Ticket $ticket)
    {
        $ticket->update(['approval_status' => 'approved']);
        return back()->with('success', 'Pengajuan dana berhasil disetujui.');
    }

    public function rejectTicket(Ticket $ticket)
    {
        $ticket->update(['approval_status' => 'rejected']);
        return back()->with('success', 'Pengajuan dana telah ditolak.');
    }

    public function users()
    {
        $admins = \App\Models\User::where('role', 'admin')->latest()->get();
        $tenants = \App\Models\User::where('role', 'tenant')->latest()->get();

        return view('owner.users.index', compact('admins', 'tenants'));
    }

    public function createUser()
    {
        return view('owner.users.create');
    }

    public function storeUser(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,tenant',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'role' => $validated['role'],
            'phone' => $validated['phone'],
        ]);

        // Generate OTP
        $otp = sprintf("%06d", mt_rand(1, 999999));
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        // Send OTP
        try {
            \Illuminate\Support\Facades\Mail::raw("Kode OTP untuk memverifikasi akun Anda adalah: {$otp}", function($msg) use ($user) {
                $msg->to($user->email)->subject('Kode OTP Verifikasi Akun Baru Jessa Kost');
            });
        } catch (\Exception $e) {
            // Log or ignore if mail fails locally
        }

        // Simpan id user ke session
        $request->session()->put('verify_new_user_id', $user->id);

        return redirect()->route('owner.users.verify_form')->with('success', 'OTP telah dikirim ke email. Masukkan OTP untuk memverifikasi.');
    }

    public function verifyUserForm(\Illuminate\Http\Request $request)
    {
        if (!$request->session()->has('verify_new_user_id')) {
            return redirect()->route('owner.users.index');
        }
        $userId = $request->session()->get('verify_new_user_id');
        $userToVerify = \App\Models\User::find($userId);
        
        return view('owner.users.verify', compact('userToVerify'));
    }

    public function verifyUserSubmit(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp_code' => 'required|string|size:6',
        ]);

        $user = \App\Models\User::find($request->user_id);

        if ($user->otp_code === $request->otp_code && $user->otp_expires_at > now()) {
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->email_verified_at = now();
            $user->save();

            $request->session()->forget('verify_new_user_id');
            return redirect()->route('owner.users.index')->with('success', 'Pengguna berhasil dibuat dan diverifikasi!');
        }

        return back()->with('error', 'Kode OTP salah atau kedaluwarsa.')->with('verify_new_user_id', $user->id);
    }

    public function editUser(\App\Models\User $user)
    {
        return view('owner.users.edit', compact('user'));
    }

    public function updateUser(\Illuminate\Http\Request $request, \App\Models\User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,tenant',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->phone = $validated['phone'];

        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('owner.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroyUser(\App\Models\User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('owner.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function expenses()
    {
        $expenses = \App\Models\Expense::with('user')->latest('expense_date')->get();
        return view('owner.expenses.index', compact('expenses'));
    }

    public function storeExpense(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'category' => 'required|string|max:255',
            'proof_image' => 'nullable|image|max:5120',
            'notes' => 'nullable|string',
        ]);

        $expense = new \App\Models\Expense();
        $expense->user_id = auth()->id();
        $expense->title = $validated['title'];
        $expense->amount = $validated['amount'];
        $expense->expense_date = $validated['expense_date'];
        $expense->category = $validated['category'];
        $expense->notes = $validated['notes'];

        if ($request->hasFile('proof_image')) {
            $expense->proof_image_path = $request->file('proof_image')->store('expenses', 'public');
        }

        $expense->save();

        return redirect()->route('owner.expenses.index')->with('success', 'Pengeluaran berhasil dicatat.');
    }

    public function payments(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Lease::with(['user', 'room', 'bills']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('room', function($q) use ($search) {
                $q->where('room_number', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        if ($request->filled('payment_status')) {
            $paymentStatus = $request->payment_status;
            $query->whereHas('bills', function($q) use ($paymentStatus) {
                $q->where('type', 'rent')->where('status', $paymentStatus);
            });
        }

        $leases = $query->get();
        return view('owner.payments.index', compact('leases'));
    }
}
