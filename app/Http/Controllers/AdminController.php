<?php

namespace App\Http\Controllers;

use App\Models\GuestLog;
use App\Models\Room;
use App\Models\Ticket;

class AdminController extends Controller
{
    public function dashboard()
    {
        $rooms = Room::all();
        $totalRooms = $rooms->count();
        $occupiedRooms = $rooms->where('status', 'occupied')->count();
        $emptyRooms = $totalRooms - $occupiedRooms;
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100) : 0;

        $activeTickets = Ticket::where('status', '!=', 'resolved')->count();
        $recentTickets = Ticket::with('user', 'room')->latest()->take(5)->get();

        $todayGuests = GuestLog::whereDate('visit_date', today())->count();
        $recentGuests = GuestLog::latest('created_at')->take(4)->get();

        // Financial Data (Current Month)
        $currentMonth = now()->format('Y-m');
        $thisMonthBills = \App\Models\Bill::where('billing_period', $currentMonth)->get();

        $totalRevenue = $thisMonthBills->where('status', 'paid')->sum('amount');
        $pendingRevenue = $thisMonthBills->where('status', 'pending')->sum('amount');
        $unpaidBillsCount = $thisMonthBills->where('status', 'pending')->count();

        $recentPayments = \App\Models\Bill::with('lease.user', 'lease.room')
            ->where('status', 'paid')
            ->orderBy('paid_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'rooms', 'totalRooms', 'occupiedRooms', 'emptyRooms', 'occupancyRate',
            'activeTickets', 'recentTickets',
            'todayGuests', 'recentGuests',
            'totalRevenue', 'pendingRevenue', 'unpaidBillsCount', 'recentPayments'
        ));
    }

    public function electricityIndex()
    {
        // Get all electricity bills for the current month, or recent ones
        $electricityBills = \App\Models\Bill::with('lease.room', 'lease.user')
            ->where('type', 'electricity')
            ->latest()
            ->paginate(15);

        return view('admin.electricity.index', compact('electricityBills'));
    }

    public function electricityCreate()
    {
        $rooms = Room::with(['leases' => function($query) {
            $query->where('is_active', true)->with('user');
        }])->where('status', 'occupied')->get();

        return view('admin.electricity.create', compact('rooms'));
    }

    public function storeElectricity(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'reading_date' => 'required|date',
            'kwh_value' => 'required|numeric|min:0',
            'file-upload' => 'nullable|image|max:10240',
        ]);

        $room = Room::with(['leases' => function($q) {
            $q->where('is_active', true);
        }])->findOrFail($request->room_id);

        $activeLease = $room->leases->first();
        if (!$activeLease) {
            return back()->with('error', 'Kamar ini tidak memiliki penghuni aktif.');
        }

        // Cari pencatatan bulan sebelumnya
        $lastReading = \App\Models\ElectricityReading::where('room_id', $room->id)
            ->latest('reading_month')
            ->first();

        $kwhDifference = $lastReading ? max(0, $request->kwh_value - $lastReading->kwh_used) : $request->kwh_value;
        $tarifPerKwh = 1500; // Contoh tarif
        $amount = $kwhDifference * $tarifPerKwh;

        // Simpan pencatatan
        \App\Models\ElectricityReading::create([
            'room_id' => $room->id,
            'reading_month' => \Carbon\Carbon::parse($request->reading_date)->format('Y-m'),
            'kwh_used' => $request->kwh_value,
            'image_path' => $request->hasFile('file-upload') ? $request->file('file-upload')->store('electricity', 'public') : null,
        ]);

        // Buat tagihan baru untuk tenant
        \App\Models\Bill::create([
            'lease_id' => $activeLease->id,
            'amount' => $amount,
            'type' => 'electricity',
            'status' => 'unpaid',
            'billing_period' => \Carbon\Carbon::parse($request->reading_date)->format('Y-m'),
            'due_date' => \Carbon\Carbon::parse($request->reading_date)->addDays(10), // Jatuh tempo 10 hari setelah pencatatan
        ]);

        return redirect()->route('admin.electricity.index')->with('success', 'Pencatatan meteran berhasil dan tagihan listrik telah dibuat.');
    }

    public function electricityShow(\App\Models\Bill $bill)
    {
        $bill->load('lease.room', 'lease.user');

        // Find corresponding reading
        $reading = \App\Models\ElectricityReading::where('room_id', $bill->lease->room_id)
            ->where('reading_month', $bill->billing_period)
            ->first();

        return view('admin.electricity.show', compact('bill', 'reading'));
    }

    public function uploadTokenProof(\Illuminate\Http\Request $request, \App\Models\Bill $bill)
    {
        $request->validate([
            'token_code' => 'required|string',
            'token_proof' => 'required|image|max:5120',
        ]);

        $path = $request->file('token_proof')->store('tokens', 'public');

        $bill->update([
            'token_code' => $request->token_code,
            'token_proof_path' => $path,
        ]);

        return back()->with('success', 'Bukti pengisian token berhasil diunggah.');
    }

    public function rooms()
    {
        $rooms = Room::orderBy('room_number')->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function createRoom()
    {
        return view('admin.rooms.create');
    }

    public function storeRoom(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number',
            'price_per_month' => 'required|numeric|min:0',
            'status' => 'required|in:available,occupied,maintenance',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:5120',
            'detail_images.*' => 'nullable|image|max:5120',
        ]);

        $room = new Room();
        $room->room_number = $validated['room_number'];
        $room->price_per_month = $validated['price_per_month'];
        $room->status = $validated['status'];
        $room->description = $validated['description'];

        if ($request->hasFile('cover_image')) {
            $room->cover_image_path = $request->file('cover_image')->store('rooms', 'public');
        }

        if ($request->hasFile('detail_images')) {
            $paths = [];
            foreach ($request->file('detail_images') as $file) {
                $paths[] = $file->store('rooms/details', 'public');
            }
            $room->detail_image_paths = $paths;
        }

        $room->save();

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function editRoom(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function updateRoom(\Illuminate\Http\Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number,' . $room->id,
            'price_per_month' => 'required|numeric|min:0',
            'status' => 'required|in:available,occupied,maintenance',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:5120',
            'detail_images.*' => 'nullable|image|max:5120',
        ]);

        $room->room_number = $validated['room_number'];
        $room->price_per_month = $validated['price_per_month'];
        $room->status = $validated['status'];
        $room->description = $validated['description'];

        if ($request->hasFile('cover_image')) {
            $room->cover_image_path = $request->file('cover_image')->store('rooms', 'public');
        }

        if ($request->hasFile('detail_images')) {
            $paths = $room->detail_image_paths ?? [];
            foreach ($request->file('detail_images') as $file) {
                $paths[] = $file->store('rooms/details', 'public');
            }
            $room->detail_image_paths = $paths;
        }

        $room->save();

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroyRoom(Room $room)
    {
        // Optionally delete files from storage here
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus.');
    }

    public function guests(\Illuminate\Http\Request $request)
    {
        $query = GuestLog::with(['tenant.leases' => function ($q) {
            $q->where('is_active', true)->with('room');
        }])->latest('visit_date');

        if ($request->filled('search')) {
            $query->where('visitor_name', 'like', '%' . $request->search . '%')
                  ->orWhere('purpose', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            if ($request->type == 'overnight') {
                $query->where('is_overnight', true);
            } elseif ($request->type == 'visit') {
                $query->where('is_overnight', false);
            }
        }

        if ($request->filled('room_id')) {
            $roomId = $request->room_id;
            $query->whereHas('tenant.leases', function($q) use ($roomId) {
                $q->where('room_id', $roomId)->where('is_active', true);
            });
        }

        $guests = $query->get();
        $rooms = Room::orderBy('room_number')->get();

        // Ambil data tenant aktif untuk form Buat Tamu
        $tenants = User::where('role', 'tenant')->whereHas('leases', function($q) {
            $q->where('is_active', true);
        })->get();

        return view('admin.guests.index', compact('guests', 'rooms', 'tenants'));
    }

    public function storeGuest(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:users,id',
            'visitor_name' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'purpose' => 'required|string|max:255',
            'is_overnight' => 'boolean',
            'id_card_photo' => 'nullable|image|max:2048',
        ]);

        $validated['related_tenant_id'] = $validated['tenant_id'];
        $validated['is_overnight'] = $request->boolean('is_overnight');
        unset($validated['tenant_id']);

        if ($request->hasFile('id_card_photo')) {
            $validated['id_card_photo_path'] = $request->file('id_card_photo')->store('guests', 'public');
        }

        \App\Models\GuestLog::create($validated);

        return back()->with('success', 'Tamu berhasil dicatat!');
    }

    public function tickets(\Illuminate\Http\Request $request)
    {
        $query = Ticket::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $tickets = $query->get();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function announcements()
    {
        $announcements = \App\Models\Announcement::orderByRaw("FIELD(priority, 'urgent', 'important', 'normal')")->latest()->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function createAnnouncement()
    {
        return view('admin.announcements.create');
    }

    public function storeAnnouncement(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'priority' => 'required|in:low,normal,high',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_active'] = true;

        \App\Models\Announcement::create($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function editAnnouncement(\App\Models\Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function updateAnnouncement(\Illuminate\Http\Request $request, \App\Models\Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'priority' => 'required|in:low,normal,high',
            'is_active' => 'boolean',
        ]);

        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroyAnnouncement(\App\Models\Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function updateTicket(\Illuminate\Http\Request $request, \App\Models\Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $ticket->update($validated);

        return redirect()->route('admin.tickets.index')->with('success', 'Status tiket berhasil diperbarui.');
    }

    public function wifiIndex()
    {
        $wifiNetworks = \App\Models\WifiNetwork::latest()->get();
        $tenants = \App\Models\User::where('role', 'tenant')->whereHas('leases', function($q) {
            $q->where('is_active', true);
        })->get();
        return view('admin.wifi.index', compact('wifiNetworks', 'tenants'));
    }

    public function wifiStore(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ssid' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        \App\Models\WifiNetwork::create($validated);

        return redirect()->route('admin.wifi.index')->with('success', 'WiFi network created successfully.');
    }

    public function wifiUpdate(\Illuminate\Http\Request $request, \App\Models\WifiNetwork $wifi)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ssid' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $wifi->update($validated);

        return redirect()->route('admin.wifi.index')->with('success', 'WiFi network updated successfully.');
    }

    public function wifiDestroy(\App\Models\WifiNetwork $wifi)
    {
        $wifi->delete();
        return redirect()->route('admin.wifi.index')->with('success', 'WiFi network deleted successfully.');
    }

    public function storeWifiBill(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:users,id',
            'billing_period' => 'required|string|max:20',
            'amount' => 'required|numeric|min:0',
        ]);

        $tenant = \App\Models\User::with(['leases' => function($q) {
            $q->where('is_active', true);
        }])->findOrFail($validated['tenant_id']);

        $activeLease = $tenant->leases->first();
        if (!$activeLease) {
            return back()->with('error', 'Penghuni ini tidak memiliki kamar aktif.');
        }

        \App\Models\Bill::create([
            'lease_id' => $activeLease->id,
            'type' => 'internet',
            'amount' => $validated['amount'],
            'billing_period' => $validated['billing_period'],
            'due_date' => now()->addDays(7),
            'status' => 'unpaid',
        ]);

        return back()->with('success', 'Tagihan WiFi berhasil dikirim ke penghuni!');
    }

    public function expenses()
    {
        $expenses = \App\Models\Expense::with('user')->latest('expense_date')->get();
        return view('admin.expenses.index', compact('expenses'));
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

        return redirect()->route('admin.expenses.index')->with('success', 'Pengeluaran berhasil dicatat.');
    }
}
