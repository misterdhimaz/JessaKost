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

        $wifiNetworks = \App\Models\WifiNetwork::all();

        return view('tenant.dashboard', compact('user', 'lease', 'bills', 'wifiNetworks'));
    }

    public function tickets(Request $request)
    {
        $tickets = Ticket::where('user_id', $request->user()->id)->latest()->get();

        return view('tenant.tickets.index', compact('tickets'));
    }

    public function createTicket()
    {
        return view('tenant.tickets.create');
    }

    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $lease = \App\Models\Lease::where('user_id', $request->user()->id)
            ->where('is_active', true)->first();

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('tickets', 'public');
        }

        $validated['user_id'] = $request->user()->id;
        $validated['room_id'] = $lease ? $lease->room_id : null;
        $validated['status'] = 'pending';

        \App\Models\Ticket::create(\Illuminate\Support\Arr::except($validated, ['image']));

        return redirect()->route('tenant.tickets.index')->with('success', 'Keluhan berhasil dikirim.');
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

    public function payBill(Request $request, Bill $bill)
    {
        $user = $request->user();
        $lease = Lease::where('user_id', $user->id)->where('is_active', true)->first();

        if (!$lease || $bill->lease_id !== $lease->id) {
            abort(403, 'Unauthorized to pay this bill.');
        }

        if ($bill->status === 'paid') {
            return redirect()->route('tenant.bills.index')->with('success', 'Tagihan ini sudah dibayar.');
        }

        // Generate Mayar Invoice
        $apiKey = config('mayar.api_key');
        $isProduction = config('mayar.is_production');
        $baseUrl = $isProduction ? 'https://api.mayar.id/hl/v1' : 'https://api.mayar.club/hl/v1';

        // Assuming user has phone in profile, or fallback
        $mobile = $user->phone ?? '081234567890';

        $typeLabel = $bill->type === 'rent' ? 'Sewa Kamar' : ($bill->type === 'electricity' ? 'Listrik' : 'Tagihan Lainnya');

        $payload = [
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => $mobile,
            'description' => "Pembayaran Tagihan {$typeLabel} - Jessa Kost",
            'redirectUrl' => route('tenant.bills.index'),
            'items' => [
                [
                    'quantity' => 1,
                    'rate' => $bill->amount,
                    'description' => "Tagihan {$typeLabel} " . \Carbon\Carbon::parse($bill->billing_period)->translatedFormat('F Y')
                ]
            ],
            'extraData' => [
                'billId' => $bill->id
            ]
        ];

        $response = \Illuminate\Support\Facades\Http::withToken($apiKey)->post("{$baseUrl}/invoice/create", $payload);

        if ($response->successful() && isset($response->json()['data']['link'])) {
            return redirect()->away($response->json()['data']['link']);
        }

        \Illuminate\Support\Facades\Log::error('Mayar API Error: ' . $response->body());
        return redirect()->route('tenant.bills.index')->with('error', 'Gagal membuat tautan pembayaran. Pastikan API Key Mayar Anda valid.');
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

        $userUpdate = ['name' => $validated['name']];

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $userUpdate['profile_photo_path'] = $path;
        }

        $user->update($userUpdate);

        $profileData = \Illuminate\Support\Arr::except($validated, ['name', 'profile_photo']);

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
