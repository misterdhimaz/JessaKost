<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/profil', [PublicController::class, 'profil'])->name('profil');
Route::get('/fasilitas', [PublicController::class, 'fasilitas'])->name('fasilitas');
Route::get('/kamar', [PublicController::class, 'kamar'])->name('kamar');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');

Route::get('/dashboard', function () {
    $role = request()->user()->role;
    if ($role === 'tenant') return redirect()->route('tenant.dashboard');
    if ($role === 'admin') return redirect()->route('admin.dashboard');
    if ($role === 'owner') return redirect()->route('owner.dashboard');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Tenant Routes
Route::middleware(['auth', 'role:tenant'])->prefix('tenant')->name('tenant.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\TenantController::class, 'dashboard'])->name('dashboard');
    Route::get('/bills', [\App\Http\Controllers\TenantController::class, 'bills'])->name('bills.index');
    Route::get('/tickets', [\App\Http\Controllers\TenantController::class, 'tickets'])->name('tickets.index');
    Route::get('/tickets/create', [\App\Http\Controllers\TenantController::class, 'createTicket'])->name('tickets.create');
    Route::get('/announcements', [\App\Http\Controllers\TenantController::class, 'announcements'])->name('announcements.index');
    Route::get('/profile', [\App\Http\Controllers\TenantController::class, 'profile'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\TenantController::class, 'updateProfile'])->name('profile.update');
    Route::get('/guests', [\App\Http\Controllers\TenantController::class, 'guests'])->name('guests.index');
    Route::get('/guests/create', [\App\Http\Controllers\TenantController::class, 'createGuest'])->name('guests.create');
    Route::post('/guests', [\App\Http\Controllers\TenantController::class, 'storeGuest'])->name('guests.store');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/rooms', [\App\Http\Controllers\AdminController::class, 'rooms'])->name('rooms.index');
    Route::get('/guests', [\App\Http\Controllers\AdminController::class, 'guests'])->name('guests.index');
    Route::get('/electricity', [\App\Http\Controllers\AdminController::class, 'electricityInput'])->name('electricity.input');
    Route::get('/tickets', [\App\Http\Controllers\AdminController::class, 'tickets'])->name('tickets.index');
    Route::get('/announcements', [\App\Http\Controllers\AdminController::class, 'announcements'])->name('announcements.index');
    Route::get('/announcements/create', [\App\Http\Controllers\AdminController::class, 'createAnnouncement'])->name('announcements.create');
    Route::post('/announcements', [\App\Http\Controllers\AdminController::class, 'storeAnnouncement'])->name('announcements.store');
});

// Owner Routes
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\OwnerController::class, 'dashboard'])->name('dashboard');
    Route::get('/reports', [\App\Http\Controllers\OwnerController::class, 'reports'])->name('reports.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('webhook/midtrans', [\App\Http\Controllers\WebhookController::class, 'handleMidtrans']);

require __DIR__.'/auth.php';
