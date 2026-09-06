<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Owner
        User::factory()->create([
            'name' => 'Bapak Owner',
            'email' => 'owner@smartkost.com',
            'role' => 'owner',
            'password' => bcrypt('password'),
        ]);

        // Create Admin
        User::factory()->create([
            'name' => 'Bapak Admin',
            'email' => 'admin@smartkost.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Create Tenant
        $tenant = User::factory()->create([
            'name' => 'Dimas',
            'email' => 'dimas@smartkost.com',
            'role' => 'tenant',
            'password' => bcrypt('password'),
        ]);

        // Create Rooms
        \App\Models\Room::create(['room_number' => '101', 'price_per_month' => 1500000, 'status' => 'available']);
        $room = \App\Models\Room::create(['room_number' => '102', 'price_per_month' => 1500000, 'status' => 'occupied']);
        \App\Models\Room::create(['room_number' => '103', 'price_per_month' => 1700000, 'status' => 'available']);

        // Create Lease
        $lease = \App\Models\Lease::create([
            'user_id' => $tenant->id,
            'room_id' => $room->id,
            'start_date' => now()->startOfMonth(),
            'end_date' => now()->addMonths(11)->endOfMonth(),
            'is_active' => true,
        ]);

        // Create a Rent Bill
        \App\Models\Bill::create([
            'lease_id' => $lease->id,
            'type' => 'rent',
            'amount' => 1500000,
            'due_date' => now()->addDays(5),
            'status' => 'unpaid'
        ]);

        // Create an Electricity Bill
        \App\Models\Bill::create([
            'lease_id' => $lease->id,
            'type' => 'electricity',
            'amount' => 125000,
            'due_date' => now()->addDays(5),
            'status' => 'unpaid'
        ]);

        // Create an Internet Bill
        \App\Models\Bill::create([
            'lease_id' => $lease->id,
            'type' => 'internet',
            'amount' => 75000,
            'due_date' => now()->addDays(5),
            'status' => 'unpaid'
        ]);

        // Create some Announcements
        $admin = \App\Models\User::where('role', 'admin')->first();
        \App\Models\Announcement::create([
            'user_id' => $admin->id,
            'title' => 'Pemadaman Listrik Terencana',
            'body' => "Diberitahukan kepada seluruh penghuni Jessa Kost, bahwa pada hari Minggu besok akan ada pemadaman listrik dari pihak PLN mulai pukul 09.00 s/d 14.00 WIB.\n\nHarap mempersiapkan segala sesuatunya.",
            'priority' => 'important',
            'is_active' => true,
        ]);

        \App\Models\Announcement::create([
            'user_id' => $admin->id,
            'title' => 'Jadwal Kebersihan Kamar Mandi',
            'body' => "Pembersihan kamar mandi luar akan dilakukan setiap hari Selasa dan Jumat pagi. Mohon kerjasamanya untuk menjaga kebersihan fasilitas bersama.",
            'priority' => 'normal',
            'is_active' => true,
        ]);
    }
}
