<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;

class PublicController extends Controller
{
    public function home()
    {
        $featuredRooms = Room::where('status', 'available')->take(3)->get();
        return view('public.home', compact('featuredRooms'));
    }

    public function profil()
    {
        return view('public.profil');
    }

    public function fasilitas()
    {
        return view('public.fasilitas');
    }

    public function kamar(Request $request)
    {
        $query = Room::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $rooms = $query->get();
        return view('public.kamar', compact('rooms'));
    }

    public function kontak()
    {
        return view('public.kontak');
    }
}
