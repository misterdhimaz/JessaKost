<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Lease;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->user();
        $lease = Lease::where('user_id', $user->id)->where('is_active', true)->first();

        $bills = collect();
        if ($lease) {
            $bills = Bill::where('lease_id', $lease->id)->where('status', 'unpaid')->get();
        }

        return view('tenant.dashboard', compact('user', 'lease', 'bills'));
    }

    public function createTicket()
    {
        return view('tenant.tickets.create');
    }

    public function tickets(Request $request)
    {
        $tickets = Ticket::where('user_id', $request->user()->id)->latest()->get();

        return view('tenant.tickets.index', compact('tickets'));
    }

    public function bills(Request $request)
    {
        $user = $request->user();
        $lease = Lease::where('user_id', $user->id)->where('is_active', true)->first();

        $bills = collect();
        if ($lease) {
            $bills = Bill::where('lease_id', $lease->id)->latest()->get();
        }

        return view('tenant.bills.index', compact('bills', 'lease'));
    }

    public function announcements()
    {
        $announcements = \App\Models\Announcement::where('is_active', true)->latest()->get();
        return view('tenant.announcements.index', compact('announcements'));
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        $profile = $user->tenantProfile ?? new \App\Models\TenantProfile();
        return view('tenant.profile.edit', compact('user', 'profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'nullable|string|max:50',
            'campus' => 'nullable|string|max:100',
            'origin_address' => 'nullable|string',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:50',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user->update(['name' => $validated['name']]);

        $profileData = \Illuminate\Support\Arr::except($validated, ['name', 'profile_photo']);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $profileData['profile_photo_path'] = $path;
        }

        if ($user->tenantProfile) {
            $user->tenantProfile->update($profileData);
        } else {
            $user->tenantProfile()->create($profileData);
        }

        return redirect()->route('tenant.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    public function guests(Request $request)
    {
        $guests = \App\Models\GuestLog::where('related_tenant_id', $request->user()->id)->latest()->get();
        return view('tenant.guests.index', compact('guests'));
    }

    public function createGuest()
    {
        return view('tenant.guests.create');
    }

    public function storeGuest(Request $request)
    {
        $validated = $request->validate([
            'visitor_name' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'purpose' => 'required|string|max:255',
            'is_overnight' => 'boolean',
            'id_card_photo' => 'nullable|image|max:2048',
        ]);

        $validated['related_tenant_id'] = $request->user()->id;
        $validated['is_overnight'] = $request->boolean('is_overnight');

        if ($request->hasFile('id_card_photo')) {
            $validated['id_card_photo_path'] = $request->file('id_card_photo')->store('guests', 'public');
        } elseif ($request->filled('id_card_base64')) {
            $image_parts = explode(";base64,", $request->id_card_base64);
            if (count($image_parts) == 2) {
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1] ?? 'jpeg';
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = 'guests/' . uniqid() . '.' . $image_type;
                \Illuminate\Support\Facades\Storage::disk('public')->put($fileName, $image_base64);
                $validated['id_card_photo_path'] = $fileName;
            }
        }

        \App\Models\GuestLog::create(\Illuminate\Support\Arr::except($validated, ['id_card_photo']));

        return redirect()->route('tenant.guests.index')->with('success', 'Buku tamu berhasil diisi.');
    }
}
