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
        $query = Bill::with('lease.room', 'lease.user')->where('status', 'paid');

        // Simple filtering
        if ($request->filled('month')) {
            $query->whereMonth('paid_at', $request->month);
        }
        if ($request->filled('year')) {
            $query->whereYear('paid_at', $request->year);
        }

        $paidBills = $query->latest('paid_at')->get();
        $totalIncome = $paidBills->sum('amount');

        return view('owner.reports.index', compact('paidBills', 'totalIncome'));
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

        return redirect()->route('owner.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
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

    public function payments()
    {
        $leases = \App\Models\Lease::with('user', 'room', 'bills')->get();
        return view('owner.payments.index', compact('leases'));
    }
}
