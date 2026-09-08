<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jessa Kost') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #f8fafc; overflow-x: hidden; }

        /* Modern Floating & Glass Styles */
        .glass-panel {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            color: #64748b;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(142, 21, 55, 0.08), rgba(142, 21, 55, 0.02));
            z-index: -1;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 1rem;
        }

        .sidebar-link:hover {
            color: #8E1537;
            transform: translateX(4px);
        }

        .sidebar-link:hover::before {
            transform: scaleX(1);
        }

        .sidebar-link.active {
            color: white;
            background: linear-gradient(135deg, #8E1537, #6b0f29);
            box-shadow: 0 10px 25px -5px rgba(142, 21, 55, 0.4), 0 8px 10px -6px rgba(142, 21, 55, 0.1);
        }

        .sidebar-link.active .icon-box {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: scale(1.1);
        }

        .icon-box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.75rem;
            background: #f1f5f9;
            color: #94a3b8;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover .icon-box {
            background: rgba(142, 21, 55, 0.1);
            color: #8E1537;
        }

        /* Ambient Background Animations */
        .ambient-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.6;
            animation: float 20s infinite ease-in-out alternate;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0, 0) scale(1); }
        }

        .orb-1 { top: -10%; left: -5%; width: 400px; height: 400px; background: rgba(142, 21, 55, 0.15); animation-delay: 0s; }
        .orb-2 { bottom: -10%; right: -5%; width: 500px; height: 500px; background: rgba(245, 235, 224, 0.6); animation-delay: -5s; }
        .orb-3 { top: 40%; left: 60%; width: 300px; height: 300px; background: rgba(59, 130, 246, 0.08); animation-delay: -10s; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="text-gray-800 antialiased selection:bg-jessa-maroon selection:text-white" x-data="{ sidebarOpen: false, loaded: false }" x-init="setTimeout(() => loaded = true, 100)">

    <!-- Ambient Background Decorations -->
    <div class="ambient-orb orb-1"></div>
    <div class="ambient-orb orb-2"></div>
    <div class="ambient-orb orb-3"></div>

    <div class="min-h-screen flex relative z-0">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-40 lg:hidden"
             @click="sidebarOpen = false"
             style="display: none;"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 w-[280px] lg:translate-x-0 transition-transform duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] z-50 lg:z-40 flex flex-col glass-panel shadow-2xl lg:shadow-none lg:m-4 lg:h-[calc(100vh-2rem)] lg:rounded-3xl">

            <!-- Logo area -->
            <div class="h-24 flex items-center justify-between px-8 border-b border-gray-100/50 shrink-0">
                <a href="/" class="flex items-center gap-3 group">
                    <!-- Menampilkan Logo Baru Anda -->
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105 group-hover:rotate-3" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden'); this.nextElementSibling.classList.add('flex');">

                    <!-- Fallback -->
                    <div class="hidden w-12 h-12 bg-gradient-to-br from-jessa-maroon to-red-900 rounded-2xl items-center justify-center text-white shadow-lg shadow-jessa-maroon/30 group-hover:scale-105 group-hover:rotate-3 transition-all duration-300">
                        <i class="fas fa-building text-xl"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-black tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600">Jessa Kost</h1>
                        <p class="text-[10px] text-jessa-maroon font-bold uppercase tracking-widest">Smart Living</p>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden w-8 h-8 flex items-center justify-center rounded-xl bg-gray-100 text-gray-500 hover:bg-gray-200 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation Links -->

            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1 relative custom-scrollbar">

                {{-- Dashboard Link (All Roles) --}}
                <div class="px-3 mb-3 mt-2 text-[10px] font-black text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-jessa-maroon"></span> Menu Utama
                </div>
                @if(Auth::user()->role === 'tenant')
                <a href="{{ route('tenant.dashboard') }}" class="sidebar-link {{ request()->routeIs('tenant.dashboard') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-home"></i></span> Beranda
                </a>
                @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-chart-pie"></i></span> Dasbor
                </a>
                @elseif(Auth::user()->role === 'owner')
                <a href="{{ route('owner.dashboard') }}" class="sidebar-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-chart-line"></i></span> Dasbor Utama
                </a>
                @endif

                {{-- Tenant Links --}}
                @if(Auth::user()->role === 'tenant')
                <div class="px-3 mt-8 mb-3 text-[10px] font-black text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-400"></span> Pembayaran & Aktivitas
                </div>
                <a href="{{ route('tenant.bills.index') }}" class="sidebar-link {{ request()->routeIs('tenant.bills.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-receipt"></i></span> Tagihan & Bayar
                </a>
                <a href="{{ route('tenant.guests.index') }}" class="sidebar-link {{ request()->routeIs('tenant.guests.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-address-book"></i></span> Buku Tamu
                </a>

                <div class="px-3 mt-8 mb-3 text-[10px] font-black text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span> Bantuan
                </div>
                <a href="{{ route('tenant.announcements.index') }}" class="sidebar-link {{ request()->routeIs('tenant.announcements.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-bullhorn"></i></span> Pengumuman
                </a>
                <a href="{{ route('tenant.tickets.index') }}" class="sidebar-link {{ request()->routeIs('tenant.tickets.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-clipboard-list"></i></span> Riwayat Laporan
                </a>
                <a href="{{ route('tenant.tickets.create') }}" class="sidebar-link {{ request()->routeIs('tenant.tickets.create') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-plus-circle"></i></span> Lapor Kerusakan
                </a>
                @endif

                {{-- Admin & Owner Shared Links --}}
                @if(in_array(Auth::user()->role, ['admin', 'owner']))
                <div class="px-3 mt-8 mb-3 text-[10px] font-black text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-400"></span> Operasional
                </div>
                <a href="{{ route('admin.rooms.index') }}" class="sidebar-link {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-door-open"></i></span> Kelola Kamar
                </a>
                <a href="{{ route('admin.guests.index') }}" class="sidebar-link {{ request()->routeIs('admin.guests.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-user-friends"></i></span> Log Tamu
                </a>
                <a href="{{ route('admin.electricity.index') }}" class="sidebar-link {{ request()->routeIs('admin.electricity.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-bolt"></i></span> Manajemen Listrik
                </a>
                <a href="{{ route('admin.tickets.index') }}" class="sidebar-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-tools"></i></span> Laporan Kerusakan
                </a>
                <a href="{{ route('admin.announcements.index') }}" class="sidebar-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-bullhorn"></i></span> Kelola Pengumuman
                </a>
                @endif

                {{-- Owner Specific Links --}}
                @if(Auth::user()->role === 'owner')
                <div class="px-3 mt-8 mb-3 text-[10px] font-black text-gray-400 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-jessa-maroon"></span> Eksekutif (Owner)
                </div>
                <a href="{{ route('owner.reports.index') }}" class="sidebar-link {{ request()->routeIs('owner.reports.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-file-invoice-dollar"></i></span> Laporan Keuangan
                </a>
                <a href="{{ route('owner.users.index') }}" class="sidebar-link {{ request()->routeIs('owner.users.*') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-users-cog"></i></span> Manajemen Pengguna
                </a>
                @endif
            </nav>


            <!-- User Footer Widget -->
            <div class="p-4 shrink-0">
                <div class="p-3 rounded-2xl bg-white/50 border border-white/60 shadow-[0_4px_12px_rgba(0,0,0,0.02)] flex items-center gap-3 hover:bg-white/80 transition-colors cursor-pointer group">
                    <div class="w-10 h-10 bg-gradient-to-br from-jessa-cream to-orange-100 rounded-xl overflow-hidden flex items-center justify-center text-jessa-maroon font-bold shadow-inner group-hover:scale-105 transition-transform shrink-0">
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-900 text-sm truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[11px] text-gray-500 font-bold uppercase tracking-wider truncate">{{ Auth::user()->role }}</p>
                    </div>
                    <a href="{{ Auth::user()->role === 'tenant' ? route('tenant.profile.edit') : route('profile.edit') }}" class="w-8 h-8 rounded-lg bg-gray-100/80 text-gray-400 hover:text-jessa-maroon hover:bg-jessa-maroon/10 flex items-center justify-center transition-colors">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 lg:ml-[296px] flex flex-col min-h-screen relative z-10 transition-all duration-500">

            <!-- Top Header -->
            <header class="h-20 glass-panel shadow-sm border-b border-gray-200/50 flex items-center justify-between px-4 sm:px-8 sticky top-0 lg:top-4 lg:mr-4 lg:rounded-3xl z-30 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden w-10 h-10 rounded-xl bg-white shadow-sm border border-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-50 hover:text-jessa-maroon transition-colors active:scale-95">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div x-show="loaded" x-transition:enter="transition-all ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>
                </div>

                <div class="flex items-center gap-3 sm:gap-4">
                    <!-- Notifications -->
                    <button class="w-10 h-10 rounded-xl bg-white shadow-sm border border-gray-100 flex items-center justify-center text-gray-500 hover:text-jessa-maroon hover:bg-jessa-maroon/5 transition-all hover:scale-105 active:scale-95 relative group">
                        <i class="fas fa-bell group-hover:animate-swing"></i>
                        <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 border-2 border-white rounded-full animate-pulse"></span>
                    </button>

                    <!-- Desktop User Dropdown -->
                    <div class="hidden sm:block">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-3 bg-white shadow-sm border border-gray-100 hover:border-gray-200 pl-2 pr-3 py-1.5 rounded-2xl transition-all hover:shadow-md hover:-translate-y-0.5 active:translate-y-0 active:shadow-sm">
                                    <div class="w-8 h-8 bg-gradient-to-br from-jessa-cream to-orange-100 rounded-xl overflow-hidden flex items-center justify-center text-jessa-maroon font-bold text-xs shadow-inner">
                                        @if(Auth::user()->profile_photo_path)
                                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down text-[10px] text-gray-400"></i>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="p-2 space-y-1">
                                    @if(Auth::user()->role === 'tenant')
                                    <x-dropdown-link :href="route('tenant.profile.edit')" class="rounded-xl hover:bg-gray-50 hover:text-jessa-maroon transition-colors">
                                        <i class="fas fa-user-edit mr-2 text-gray-400 w-4"></i> Profil Saya
                                    </x-dropdown-link>
                                    @else
                                    <x-dropdown-link :href="route('profile.edit')" class="rounded-xl hover:bg-gray-50 hover:text-jessa-maroon transition-colors">
                                        <i class="fas fa-user-edit mr-2 text-gray-400 w-4"></i> Profil Saya
                                    </x-dropdown-link>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="rounded-xl hover:bg-red-50 hover:text-red-600 transition-colors text-red-500 font-medium">
                                            <i class="fas fa-sign-out-alt mr-2 w-4"></i> Keluar
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-8 lg:pr-8"
                  x-show="loaded"
                  x-transition:enter="transition-all ease-out duration-700 delay-200"
                  x-transition:enter-start="opacity-0 translate-y-8"
                  x-transition:enter-end="opacity-100 translate-y-0"
                  style="display: none;">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="py-6 px-8 mt-auto text-center"
                    x-show="loaded"
                    x-transition:enter="transition-opacity ease-out duration-1000 delay-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    style="display: none;">
                <p class="text-sm text-gray-400 font-medium">
                    &copy; {{ date('Y') }} <span class="font-bold text-gray-500">Jessa Kost</span> <span class="text-jessa-maroon">&hearts;</span> Smart Management System
                </p>
            </footer>
        </div>
    </div>

    <style>
        /* Custom Keyframes */
        @keyframes swing {
            20% { transform: rotate(15deg); }
            40% { transform: rotate(-10deg); }
            60% { transform: rotate(5deg); }
            80% { transform: rotate(-5deg); }
            100% { transform: rotate(0deg); }
        }
        .animate-swing {
            animation: swing 1s ease 1;
        }
    </style>
</body>
</html>
