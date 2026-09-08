<nav x-data="{ open: false }" class="bg-jessa-maroon border-b border-jessa-maroonDark">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <!-- Menampilkan Logo Baru Anda -->
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 md:h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-105" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden'); this.nextElementSibling.classList.add('flex');">

                        <div class="hidden items-center justify-center w-8 h-8 bg-jessa-cream rounded-lg text-jessa-maroon text-xl">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <span class="text-white font-bold text-lg tracking-tight hidden sm:block">Jessa<span class="font-normal text-jessa-cream">Kost</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-jessa-cream hover:text-white hover:border-white focus:text-white focus:border-white {{ request()->routeIs('admin.dashboard') ? 'border-white text-white' : 'border-transparent' }}">
                            Dasbor
                        </x-nav-link>
                        <x-nav-link :href="route('admin.rooms.index')" :active="request()->routeIs('admin.rooms.*')" class="text-jessa-cream hover:text-white hover:border-white focus:text-white focus:border-white {{ request()->routeIs('admin.rooms.*') ? 'border-white text-white' : 'border-transparent' }}">
                            Kamar
                        </x-nav-link>
                        <x-nav-link :href="route('admin.guests.index')" :active="request()->routeIs('admin.guests.*')" class="text-jessa-cream hover:text-white hover:border-white focus:text-white focus:border-white {{ request()->routeIs('admin.guests.*') ? 'border-white text-white' : 'border-transparent' }}">
                            Buku Tamu
                        </x-nav-link>
                        <x-nav-link :href="route('admin.tickets.index')" :active="request()->routeIs('admin.tickets.*')" class="text-jessa-cream hover:text-white hover:border-white focus:text-white focus:border-white {{ request()->routeIs('admin.tickets.*') ? 'border-white text-white' : 'border-transparent' }}">
                            Laporan
                        </x-nav-link>
                    @elseif(Auth::user()->role === 'tenant')
                        <x-nav-link :href="route('tenant.dashboard')" :active="request()->routeIs('tenant.dashboard')" class="text-jessa-cream hover:text-white hover:border-white focus:text-white focus:border-white {{ request()->routeIs('tenant.dashboard') ? 'border-white text-white' : 'border-transparent' }}">
                            Beranda Saya
                        </x-nav-link>
                        <x-nav-link :href="route('tenant.bills.index')" :active="request()->routeIs('tenant.bills.*')" class="text-jessa-cream hover:text-white hover:border-white focus:text-white focus:border-white {{ request()->routeIs('tenant.bills.*') ? 'border-white text-white' : 'border-transparent' }}">
                            Tagihan & Pembayaran
                        </x-nav-link>
                        <x-nav-link :href="route('tenant.tickets.index')" :active="request()->routeIs('tenant.tickets.*')" class="text-jessa-cream hover:text-white hover:border-white focus:text-white focus:border-white {{ request()->routeIs('tenant.tickets.*') ? 'border-white text-white' : 'border-transparent' }}">
                            Laporan Fasilitas
                        </x-nav-link>
                    @elseif(Auth::user()->role === 'owner')
                        <x-nav-link :href="route('owner.dashboard')" :active="request()->routeIs('owner.dashboard')" class="text-jessa-cream hover:text-white hover:border-white focus:text-white focus:border-white {{ request()->routeIs('owner.dashboard') ? 'border-white text-white' : 'border-transparent' }}">
                            Dasbor
                        </x-nav-link>
                        <x-nav-link :href="route('owner.reports.index')" :active="request()->routeIs('owner.reports.*')" class="text-jessa-cream hover:text-white hover:border-white focus:text-white focus:border-white {{ request()->routeIs('owner.reports.*') ? 'border-white text-white' : 'border-transparent' }}">
                            Laporan Keuangan
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-jessa-maroon bg-jessa-cream hover:bg-white focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-red-600">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-jessa-cream hover:text-white hover:bg-jessa-maroonDark focus:outline-none focus:bg-jessa-maroonDark focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-jessa-maroonDark">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-jessa-cream hover:bg-white hover:text-jessa-maroon">Dasbor</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.rooms.index')" :active="request()->routeIs('admin.rooms.*')" class="text-jessa-cream hover:bg-white hover:text-jessa-maroon">Kamar</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.guests.index')" :active="request()->routeIs('admin.guests.*')" class="text-jessa-cream hover:bg-white hover:text-jessa-maroon">Buku Tamu</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.tickets.index')" :active="request()->routeIs('admin.tickets.*')" class="text-jessa-cream hover:bg-white hover:text-jessa-maroon">Laporan</x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-jessa-maroon">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-jessa-cream">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-jessa-cream hover:bg-white hover:text-jessa-maroon">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-red-400 hover:bg-white hover:text-red-600">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
