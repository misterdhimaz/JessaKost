<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jessa Kost - {{ $title ?? 'Hunian Nyaman & Modern' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Scripts & Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FBF3D5; /* Membawa kembali cream asli tapi dengan tekstur clean */
        }

        .blob-shape {
            border-radius: 41% 59% 46% 54% / 41% 50% 50% 59%;
        }

        .glass-nav {
            background: rgba(251, 243, 213, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(146, 0, 58, 0.1);
        }

        /* Modern Card Styling */
        .modern-card {
            background: #ffffff;
            border-radius: 1.5rem;
            border: 1px solid rgba(146, 0, 58, 0.05);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .modern-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(146, 0, 58, 0.1);
            border-color: rgba(146, 0, 58, 0.2);
        }

        .modern-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #92003A;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .modern-card:hover::before {
            transform: scaleX(1);
        }
    </style>
</head>
<body class="text-gray-800 selection:bg-jessa-maroon/20 selection:text-jessa-maroon flex flex-col min-h-screen relative overflow-x-hidden" x-data="{ scrolled: false, mobileMenuOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Background Pattern Halus -->
    <div class="fixed inset-0 pointer-events-none z-[-1]" style="background-image: radial-gradient(rgba(146,0,58,0.04) 2px, transparent 2px); background-size: 32px 32px;"></div>

    <!-- Navbar -->
    <nav :class="{ 'glass-nav shadow-sm py-3': scrolled, 'bg-transparent py-6': !scrolled }" class="fixed w-full z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center group">
                    <a href="{{ route('home') }}" class="text-2xl font-extrabold tracking-tighter text-jessa-maroon transition-all transform flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-jessa-maroon text-white flex items-center justify-center shadow-lg group-hover:scale-105 transition-all duration-300">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <span>Jessa<span class="font-normal text-gray-600">Kost</span></span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-2 items-center bg-white/70 px-3 py-1.5 rounded-full backdrop-blur-md border border-white shadow-sm">
                    <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('home') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:text-jessa-maroon hover:bg-jessa-maroon/5' }}">Beranda</a>
                    <a href="{{ route('profil') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('profil') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:text-jessa-maroon hover:bg-jessa-maroon/5' }}">Profil</a>
                    <a href="{{ route('fasilitas') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('fasilitas') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:text-jessa-maroon hover:bg-jessa-maroon/5' }}">Fasilitas</a>
                    <a href="{{ route('kamar') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('kamar') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:text-jessa-maroon hover:bg-jessa-maroon/5' }}">Kamar</a>
                    <a href="{{ route('kontak') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('kontak') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:text-jessa-maroon hover:bg-jessa-maroon/5' }}">Kontak</a>
                </div>

                <div class="hidden md:flex">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-6 py-2.5 rounded-full font-bold transition-all duration-300 text-jessa-maroon bg-white border border-jessa-maroon/20 hover:bg-jessa-maroon hover:text-white shadow-md flex items-center gap-2">
                                Dasbor <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full font-bold transition-all duration-300 text-white bg-jessa-maroon hover:bg-jessa-maroonDark shadow-lg flex items-center gap-2">
                                Login <i class="fas fa-sign-in-alt text-xs"></i>
                            </a>
                        @endauth
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center outline-none text-jessa-maroon">
                        <i class="fas fa-bars text-xl" x-show="!mobileMenuOpen"></i>
                        <i class="fas fa-times text-xl" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden bg-white absolute w-full shadow-xl rounded-b-3xl border-t border-gray-100" x-cloak>
            <div class="px-6 py-6 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('home') ? 'bg-jessa-maroon text-white' : 'text-gray-600 hover:bg-gray-50' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="block px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('profil') ? 'bg-jessa-maroon text-white' : 'text-gray-600 hover:bg-gray-50' }}">Profil</a>
                <a href="{{ route('fasilitas') }}" class="block px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('fasilitas') ? 'bg-jessa-maroon text-white' : 'text-gray-600 hover:bg-gray-50' }}">Fasilitas</a>
                <a href="{{ route('kamar') }}" class="block px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('kamar') ? 'bg-jessa-maroon text-white' : 'text-gray-600 hover:bg-gray-50' }}">Kamar</a>
                <a href="{{ route('kontak') }}" class="block px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('kontak') ? 'bg-jessa-maroon text-white' : 'text-gray-600 hover:bg-gray-50' }}">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow pt-24 z-10 relative">
        @yield('content')
    </main>

    <!-- UI/UX Solid Footer -->
    <footer class="relative bg-white pt-20 pb-10 mt-auto z-10 rounded-t-[3rem] shadow-[0_-10px_40px_rgba(0,0,0,0.03)] mx-2 sm:mx-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16 relative">
                <div class="md:col-span-5">
                    <a href="{{ route('home') }}" class="text-3xl font-extrabold tracking-tighter text-jessa-maroon mb-6 block flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-jessa-maroon text-white flex items-center justify-center shadow-md">
                            <i class="fas fa-leaf"></i>
                        </div>
                        Jessa<span class="font-normal text-gray-500">Kost</span>
                    </a>
                    <p class="text-gray-600 mb-8 max-w-sm leading-relaxed font-medium">
                        Tempat di mana kenyamanan bertemu dengan kemudahan. Spesial dirancang untuk produktivitas Mahasiswa UNSRI.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-jessa-cream text-jessa-maroon rounded-full flex items-center justify-center hover:bg-jessa-maroon hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-jessa-cream text-jessa-maroon rounded-full flex items-center justify-center hover:bg-jessa-maroon hover:text-white transition-colors">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-jessa-cream text-jessa-maroon rounded-full flex items-center justify-center hover:bg-jessa-maroon hover:text-white transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div class="md:col-span-3 md:col-start-7">
                    <h4 class="font-bold text-gray-900 mb-6 text-sm tracking-widest uppercase">Navigasi</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('profil') }}" class="text-gray-600 hover:text-jessa-maroon font-semibold transition-colors text-sm">Tentang Kami</a></li>
                        <li><a href="{{ route('fasilitas') }}" class="text-gray-600 hover:text-jessa-maroon font-semibold transition-colors text-sm">Fasilitas Lengkap</a></li>
                        <li><a href="{{ route('kamar') }}" class="text-gray-600 hover:text-jessa-maroon font-semibold transition-colors text-sm">Cek Ketersediaan Kamar</a></li>
                    </ul>
                </div>

                <div class="md:col-span-3">
                    <h4 class="font-bold text-gray-900 mb-6 text-sm tracking-widest uppercase">Hubungi Kami</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-gray-600 font-semibold text-sm">
                            <div class="w-8 h-8 rounded-full bg-jessa-maroon/10 flex items-center justify-center text-jessa-maroon shrink-0">
                                <i class="fas fa-map-marker-alt text-xs"></i>
                            </div>
                            <span class="mt-1">Jl. Mawar Merah No. 45<br>Indralaya, Ogan Ilir</span>
                        </li>
                        <li class="flex items-center gap-3 text-gray-600 font-semibold text-sm">
                            <div class="w-8 h-8 rounded-full bg-jessa-maroon/10 flex items-center justify-center text-jessa-maroon shrink-0">
                                <i class="fas fa-phone-alt text-xs"></i>
                            </div>
                            <span>+62 812-3456-7890</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm font-semibold">
                    &copy; {{ date('Y') }} Jessa Kost. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <!-- Initialize AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                once: true,
                offset: 30,
                duration: 800,
                easing: 'ease-out-cubic',
            });
        });
    </script>
</body>
</html>
