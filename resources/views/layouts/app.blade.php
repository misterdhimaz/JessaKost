<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jessa Kost') }} - Dasbor</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
            color: #6B7280;
        }
        .sidebar-link:hover {
            background: rgba(146, 0, 58, 0.05);
            color: #92003A;
        }
        .sidebar-link.active {
            background: rgba(146, 0, 58, 0.1);
            color: #92003A;
            font-weight: 700;
        }
        .sidebar-link .icon-box {
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        .sidebar-link:hover .icon-box,
        .sidebar-link.active .icon-box {
            background: #92003A;
            color: white;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 selection:bg-jessa-maroon/20 selection:text-jessa-maroon" x-data="{ sidebarOpen: false }">

    <div class="flex min-h-screen">

        {{-- ═══════════ SIDEBAR (Desktop Fixed) ═══════════ --}}
        <aside class="hidden lg:flex lg:flex-col lg:w-72 bg-white border-r border-gray-100 fixed inset-y-0 left-0 z-30">

            {{-- Logo --}}
            <div class="h-20 flex items-center gap-3 px-6 border-b border-gray-100 shrink-0">
                <div class="w-10 h-10 bg-jessa-maroon rounded-xl flex items-center justify-center text-white text-lg shadow-md border-t-2 border-jessa-cream">
                    <i class="fas fa-leaf"></i>
                </div>
                <div>
                    <span class="text-xl font-extrabold text-gray-900 tracking-tight">Jessa<span class="font-normal text-gray-400">Kost</span></span>
                    <p class="text-[10px] font-bold text-jessa-maroon uppercase tracking-widest -mt-0.5">{{ ucfirst(Auth::user()->role) }} Panel</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1">

                {{-- Admin Menu --}}
                @if(Auth::user()->role === 'admin')
                <div class="px-3 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie w-5"></i> Dasbor
                </a>
                <a href="{{ route('admin.rooms.index') }}" class="sidebar-link {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
                    <i class="fas fa-door-open w-5"></i> Kelola Kamar
                </a>
                <a href="{{ route('admin.electricity.input') }}" class="sidebar-link {{ request()->routeIs('admin.electricity.*') ? 'active' : '' }}">
                    <i class="fas fa-bolt w-5"></i> Meteran Listrik
                </a>

                <div class="px-3 mt-6 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Lainnya</div>
                <a href="{{ route('admin.announcements.index') }}" class="sidebar-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn w-5"></i> Pengumuman
                </a>
                <a href="{{ route('admin.guests.index') }}" class="sidebar-link {{ request()->routeIs('admin.guests.*') ? 'active' : '' }}">
                    <i class="fas fa-book-open w-5"></i> Buku Tamu
                </a>
                <a href="{{ route('admin.tickets.index') }}" class="sidebar-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
                    <i class="fas fa-headset w-5"></i> Keluhan
                </a>
                @endif

                {{-- Tenant Menu --}}
                @if(Auth::user()->role === 'tenant')
                <div class="px-3 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Menu Utama</div>
                <a href="{{ route('tenant.dashboard') }}" class="sidebar-link {{ request()->routeIs('tenant.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home w-5"></i> Beranda Saya
                </a>
                <a href="{{ route('tenant.bills.index') }}" class="sidebar-link {{ request()->routeIs('tenant.bills.*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar w-5"></i> Tagihan & Bayar
                </a>
                <a href="{{ route('tenant.guests.index') }}" class="sidebar-link {{ request()->routeIs('tenant.guests.*') ? 'active' : '' }}">
                    <i class="fas fa-address-book w-5"></i> Buku Tamu
                </a>

                <div class="px-3 mt-6 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Informasi & Bantuan</div>
                <a href="{{ route('tenant.announcements.index') }}" class="sidebar-link {{ request()->routeIs('tenant.announcements.*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn w-5"></i> Pengumuman Kost
                </a>
                <a href="{{ route('tenant.tickets.index') }}" class="sidebar-link {{ request()->routeIs('tenant.tickets.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list w-5"></i> Riwayat Laporan
                </a>
                <a href="{{ route('tenant.tickets.create') }}" class="sidebar-link {{ request()->routeIs('tenant.tickets.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle w-5"></i> Lapor Kerusakan
                </a>
                @endif

                @if(Auth::user()->role === 'owner')
                    <a href="{{ route('owner.dashboard') }}" class="sidebar-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-home"></i></span> Dasbor
                    </a>
                    <a href="{{ route('owner.reports.index') }}" class="sidebar-link {{ request()->routeIs('owner.reports.*') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-chart-bar"></i></span> Laporan Keuangan
                    </a>
                @endif
            </nav>

            {{-- User Footer --}}
            <div class="border-t border-gray-100 p-4 shrink-0">
                <div class="flex items-center gap-3 p-2">
                    <div class="w-10 h-10 bg-jessa-cream rounded-full flex items-center justify-center text-jessa-maroon font-bold text-sm shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-900 text-sm truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400 font-medium truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="w-8 h-8 rounded-lg bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-400 transition-colors">
                                <i class="fas fa-ellipsis-v text-xs"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @if(Auth::user()->role === 'tenant')
                            <x-dropdown-link :href="route('tenant.profile.edit')">
                                <i class="fas fa-user-edit mr-2 text-gray-400"></i> Profil Saya
                            </x-dropdown-link>
                            @else
                            <x-dropdown-link :href="route('profile.edit')">
                                <i class="fas fa-user-edit mr-2 text-gray-400"></i> Profil Saya
                            </x-dropdown-link>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </aside>

        {{-- ═══════════ MOBILE SIDEBAR OVERLAY ═══════════ --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/30 z-40 lg:hidden" @click="sidebarOpen = false" x-cloak></div>

        <aside x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed inset-y-0 left-0 z-50 w-72 bg-white shadow-2xl lg:hidden flex flex-col" x-cloak>

            {{-- Mobile Logo --}}
            <div class="h-20 flex items-center justify-between px-6 border-b border-gray-100 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-jessa-maroon rounded-xl flex items-center justify-center text-white text-lg shadow-md">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <span class="text-xl font-extrabold text-gray-900 tracking-tight">Jessa<span class="font-normal text-gray-400">Kost</span></span>
                </div>
                <button @click="sidebarOpen = false" class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Mobile Nav (same links) --}}
            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-3 mb-3">Menu Utama</p>

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-home"></i></span> Dasbor
                    </a>
                    <a href="{{ route('admin.rooms.index') }}" class="sidebar-link {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-bed"></i></span> Kelola Kamar
                    </a>
                    <a href="{{ route('admin.electricity.input') }}" class="sidebar-link {{ request()->routeIs('admin.electricity.*') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-bolt"></i></span> Meteran Listrik
                    </a>
                    <a href="{{ route('admin.guests.index') }}" class="sidebar-link {{ request()->routeIs('admin.guests.*') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-book-open"></i></span> Buku Tamu
                    </a>
                    <a href="{{ route('admin.tickets.index') }}" class="sidebar-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-headset"></i></span> Keluhan
                    </a>
                @elseif(Auth::user()->role === 'tenant')
                    <a href="{{ route('tenant.dashboard') }}" class="sidebar-link {{ request()->routeIs('tenant.dashboard') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-home"></i></span> Beranda Saya
                    </a>
                    <a href="{{ route('tenant.bills.index') }}" class="sidebar-link {{ request()->routeIs('tenant.bills.*') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-receipt"></i></span> Tagihan & Bayar
                    </a>
                    <a href="{{ route('tenant.guests.index') }}" class="sidebar-link {{ request()->routeIs('tenant.guests.*') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-address-book"></i></span> Buku Tamu
                    </a>

                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-3 mb-3 mt-4">Informasi & Bantuan</p>
                    <a href="{{ route('tenant.announcements.index') }}" class="sidebar-link {{ request()->routeIs('tenant.announcements.*') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-bullhorn"></i></span> Pengumuman
                    </a>
                    <a href="{{ route('tenant.tickets.index') }}" class="sidebar-link {{ request()->routeIs('tenant.tickets.*') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-clipboard-list"></i></span> Riwayat Laporan
                    </a>
                    <a href="{{ route('tenant.tickets.create') }}" class="sidebar-link {{ request()->routeIs('tenant.tickets.create') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-plus-circle"></i></span> Lapor Kerusakan
                    </a>
                @elseif(Auth::user()->role === 'owner')
                    <a href="{{ route('owner.dashboard') }}" class="sidebar-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-home"></i></span> Dasbor
                    </a>
                    <a href="{{ route('owner.reports.index') }}" class="sidebar-link {{ request()->routeIs('owner.reports.*') ? 'active' : '' }}">
                        <span class="icon-box bg-gray-100 text-gray-500"><i class="fas fa-chart-bar"></i></span> Laporan
                    </a>
                @endif
            </nav>

            {{-- Mobile User --}}
            <div class="border-t border-gray-100 p-4 shrink-0">
                <div class="flex items-center gap-3 p-2">
                    <div class="w-10 h-10 bg-jessa-cream rounded-full flex items-center justify-center text-jessa-maroon font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-900 text-sm truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400 font-medium truncate">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- ═══════════ MAIN CONTENT ═══════════ --}}
        <div class="flex-1 lg:ml-72 flex flex-col min-h-screen">

            {{-- Top Bar --}}
            <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-20">
                <div class="flex items-center gap-4">
                    {{-- Mobile hamburger --}}
                    <button @click="sidebarOpen = true" class="lg:hidden w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-colors">
                        <i class="fas fa-bars"></i>
                    </button>

                    @isset($header)
                        {{ $header }}
                    @endisset
                </div>

                <div class="flex items-center gap-4">
                    {{-- Notification bell placeholder --}}
                    <button class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors relative">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    {{-- Desktop user dropdown --}}
                    <div class="hidden sm:block">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-3 bg-gray-50 hover:bg-gray-100 pl-3 pr-2 py-1.5 rounded-xl transition-colors">
                                    <div class="w-8 h-8 bg-jessa-cream rounded-lg flex items-center justify-center text-jessa-maroon font-bold text-xs">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                    </div>
                                    <span class="text-sm font-bold text-gray-700 hidden md:block">{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down text-[10px] text-gray-400"></i>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                @if(Auth::user()->role === 'tenant')
                                <x-dropdown-link :href="route('tenant.profile.edit')">
                                    <i class="fas fa-user-edit mr-2 text-gray-400"></i> Profil Saya
                                </x-dropdown-link>
                                @else
                                <x-dropdown-link :href="route('profile.edit')">
                                    <i class="fas fa-user-edit mr-2 text-gray-400"></i> Profil Saya
                                </x-dropdown-link>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-4 sm:p-8">
                {{ $slot }}
            </main>

            {{-- Footer --}}
            <footer class="border-t border-gray-100 py-4 px-8">
                <p class="text-xs text-gray-400 font-medium text-center">&copy; {{ date('Y') }} Jessa Kost · Sistem Manajemen Pintar</p>
            </footer>
        </div>
    </div>

</body>
</html>
