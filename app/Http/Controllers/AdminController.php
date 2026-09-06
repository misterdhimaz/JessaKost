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
        $activeTickets = Ticket::where('status', '!=', 'resolved')->count();
        $todayGuests = GuestLog::whereDate('visit_date', today())->count();

        return view('admin.dashboard', compact('rooms', 'totalRooms', 'occupiedRooms', 'emptyRooms', 'activeTickets', 'todayGuests'));
    }

    public function electricityInput()
    {
        $rooms = Room::where('status', 'occupied')->get();

        return view('admin.electricity.create', compact('rooms'));
    }

    public function rooms()
    {
        $rooms = Room::all();

        return view('admin.rooms.index', compact('rooms'));
    }

    public function guests()
    {
        $guests = GuestLog::latest('visit_date')->get();

        return view('admin.guests.index', compact('guests'));
    }

    public function tickets()
    {
        $tickets = Ticket::latest()->get();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function announcements()
    {
        $announcements = \App\Models\Announcement::latest()->get();
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
            'priority' => 'required|in:normal,important,urgent',
            'is_active' => 'boolean'
        ]);

        $validated['user_id'] = auth()->id();
        \App\Models\Announcement::create($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil ditambahkan');
    }
}
