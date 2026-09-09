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
            background-color: #FAFAFA;
        }

        .blob-shape {
            border-radius: 41% 59% 46% 54% / 41% 50% 50% 59%;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
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

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(1.05); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-slow { animation: pulse-slow 8s ease-in-out infinite; }
    </style>
</head>
<body class="text-gray-800 selection:bg-jessa-maroon/20 selection:text-jessa-maroon flex flex-col min-h-screen relative overflow-x-hidden bg-white" x-data="{ mobileMenuOpen: false }">

    <!-- Background Pattern Halus -->
    <div class="fixed inset-0 pointer-events-none z-[-1]" style="background-image: radial-gradient(rgba(146,0,58,0.03) 2px, transparent 2px); background-size: 40px 40px;"></div>

    <!-- Navbar Fix Tetap (Dominan Putih) -->
    <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-[0_2px_15px_rgba(0,0,0,0.03)] border-b border-gray-100 py-3 md:py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">

            <!-- BAGIAN LOGO YANG DIUBAH (DIGESER KE KANAN ~30px) -->
            <!-- Mengurangi nilai margin kiri negatif sebanyak 8 unit (32px) -->
            <div class="flex items-center md:-ml-4 lg:-ml-16 xl:-ml-24">
                <a href="{{ route('home') }}" class="flex items-center gap-1 group">

                    <!-- Gambar Logo Lokal (Besar) -->
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Jessa Kost" class="h-20 md:h-28 w-auto object-contain -my-6 md:-my-8 shrink-0 relative z-10 group-hover:scale-105 transition-all duration-300 drop-shadow-sm">

                    <!-- Teks Jessa Kost -->
                    <div class="flex flex-col justify-center">
                        <span class="text-xl md:text-2xl font-extrabold tracking-tighter text-jessa-maroon leading-none">
                            Jessa<span class="font-normal text-gray-600">Kost</span>
                        </span>
                    </div>
                </a>
            </div>
            <!-- AKHIR BAGIAN LOGO -->

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-1 items-center bg-gray-50/50 px-2 py-1.5 rounded-full border border-gray-100">
                <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('home') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:text-jessa-maroon hover:bg-white' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('profil') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:text-jessa-maroon hover:bg-white' }}">Profil</a>
                <a href="{{ route('fasilitas') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('fasilitas') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:text-jessa-maroon hover:bg-white' }}">Fasilitas</a>
                <a href="{{ route('kamar') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('kamar') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:text-jessa-maroon hover:bg-white' }}">Kamar</a>
                <a href="{{ route('kontak') }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 {{ request()->routeIs('kontak') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:text-jessa-maroon hover:bg-white' }}">Kontak</a>
            </div>

            <!-- Right Actions -->
            <div class="hidden md:flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-6 py-2.5 rounded-full font-bold transition-all duration-300 text-jessa-maroon bg-white border border-gray-200 hover:border-jessa-maroon hover:bg-jessa-maroon/5 shadow-sm flex items-center gap-2">
                            Dasbor <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full font-bold transition-all duration-300 text-white bg-jessa-maroon hover:bg-jessa-maroonDark shadow-lg flex items-center gap-2 hover:-translate-y-0.5">
                            Login <i class="fas fa-sign-in-alt text-xs"></i>
                        </a>
                    @endauth
                @endif
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="w-10 h-10 rounded-full bg-gray-50 shadow-sm flex items-center justify-center outline-none text-jessa-maroon border border-gray-100 relative z-20">
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
         class="md:hidden bg-white absolute w-full shadow-2xl rounded-b-3xl border-t border-gray-100 top-full left-0 z-10" x-cloak>
        <div class="px-4 py-6 space-y-2 max-h-[70vh] overflow-y-auto">
            <a href="{{ route('home') }}" class="block px-5 py-4 rounded-2xl text-sm font-bold transition-colors {{ request()->routeIs('home') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:bg-gray-50 border border-transparent hover:border-gray-100' }}">Beranda</a>
            <a href="{{ route('profil') }}" class="block px-5 py-4 rounded-2xl text-sm font-bold transition-colors {{ request()->routeIs('profil') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:bg-gray-50 border border-transparent hover:border-gray-100' }}">Profil</a>
            <a href="{{ route('fasilitas') }}" class="block px-5 py-4 rounded-2xl text-sm font-bold transition-colors {{ request()->routeIs('fasilitas') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:bg-gray-50 border border-transparent hover:border-gray-100' }}">Fasilitas</a>
            <a href="{{ route('kamar') }}" class="block px-5 py-4 rounded-2xl text-sm font-bold transition-colors {{ request()->routeIs('kamar') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:bg-gray-50 border border-transparent hover:border-gray-100' }}">Kamar</a>
            <a href="{{ route('kontak') }}" class="block px-5 py-4 rounded-2xl text-sm font-bold transition-colors {{ request()->routeIs('kontak') ? 'bg-jessa-maroon text-white shadow-md' : 'text-gray-600 hover:bg-gray-50 border border-transparent hover:border-gray-100' }}">Kontak</a>

            @if (Route::has('login'))
                <div class="pt-4 mt-2 border-t border-gray-100">
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-5 py-4 text-center rounded-2xl text-sm font-bold transition-colors text-jessa-maroon bg-jessa-maroon/5 border border-jessa-maroon/20">Dasbor Aplikasi</a>
                @else
                    <a href="{{ route('login') }}" class="block px-5 py-4 text-center rounded-2xl text-sm font-bold transition-colors text-white bg-jessa-maroon shadow-lg">Login ke Sistem</a>
                @endauth
                </div>
            @endif
        </div>
    </div>
</nav>

    <!-- Page Content -->
    <main class="flex-grow pt-[80px] md:pt-[90px]">
        @yield('content')
    </main>

    <!-- UI/UX Solid Footer -->
    <footer class="relative bg-white pt-24 pb-10 mt-auto z-10 rounded-t-[3rem] sm:rounded-t-[4rem] shadow-[0_-15px_50px_rgba(0,0,0,0.03)] mx-0 sm:mx-4 border-t-8 border-jessa-cream overflow-hidden">

    <!-- Background Ornaments Footer -->
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-jessa-maroon/5 rounded-full blur-[80px] pointer-events-none"></div>
    <div class="absolute top-10 left-10 w-32 h-32 bg-jessa-cream/60 rounded-full blur-[40px] pointer-events-none animate-pulse-slow"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16 relative">
            <div class="md:col-span-5">


                <div class="flex items-center -ml-2 md:-ml-4 mb-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-1 group">
                        <!-- Gambar Logo Lokal (Ukuran disamakan dengan Navbar) -->
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Jessa Kost" class="h-20 md:h-28 w-auto object-contain shrink-0 group-hover:scale-105 transition-all duration-300 drop-shadow-sm">

                        <!-- Teks Jessa Kost -->
                        <div class="flex flex-col justify-center">
                            <span class="text-2xl md:text-3xl font-extrabold tracking-tighter text-jessa-maroon leading-none">
                                Jessa<span class="font-normal text-gray-500">Kost</span>
                            </span>
                        </div>
                    </a>
                </div>

                <p class="text-gray-600 mb-8 -mt-7 max-w-sm leading-relaxed font-medium">
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
                    <li class="flex items-start gap-3 text-gray-600 font-semibold text-sm group">
                        <div class="w-8 h-8 rounded-full bg-jessa-maroon/10 flex items-center justify-center text-jessa-maroon shrink-0 group-hover:bg-jessa-maroon group-hover:text-white transition-colors">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                        </div>
                        <a href="https://www.google.com/maps/@-3.2081346,104.6500056,12a,75y,178.42h,81.93t/data=!3m7!1e1!3m5!1sb58qy8PqhieZsumwKmN2SA!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fcb_client%3Dmaps_sv.tactile%26w%3D900%26h%3D600%26pitch%3D8.068447809181833%26panoid%3Db58qy8PqhieZsumwKmN2SA%26yaw%3D178.42180272807605!7i16384!8i8192?entry=ttu&g_ep=EgoyMDI2MDkwNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="mt-1 group-hover:text-jessa-maroon transition-colors">Jl. Mawar Merah No. 45<br>Indralaya, Ogan Ilir</a>
                    </li>
                    <li class="flex items-center gap-3 text-gray-600 font-semibold text-sm">
                        <div class="w-8 h-8 rounded-full bg-jessa-maroon/10 flex items-center justify-center text-jessa-maroon shrink-0">
                            <i class="fas fa-phone-alt text-xs"></i>
                        </div>
                        <span>+62 858-3284-1485</span>
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
