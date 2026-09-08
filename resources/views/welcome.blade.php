<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jessa Kost - Hunian Nyaman & Modern</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Scripts & Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero-bg {
            background-image: linear-gradient(rgba(44, 51, 51, 0.7), rgba(44, 51, 51, 0.8)), url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .blob-shape {
            border-radius: 41% 59% 46% 54% / 41% 50% 50% 59%;
        }
    </style>
</head>
<body class="font-sans antialiased bg-jessa-cream text-jessa-dark selection:bg-jessa-bata selection:text-white" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">

    <!-- Navbar -->
    <nav :class="{ 'bg-white/90 backdrop-blur-md shadow-md py-3': scrolled, 'bg-transparent py-5': !scrolled }" class="fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-bold tracking-tight" :class="scrolled ? 'text-jessa-bata' : 'text-jessa-cream'">
                        <i class="fas fa-leaf mr-2"></i>Jessa<span class="font-light">Kost</span>
                    </span>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#profil" class="text-sm font-medium transition-colors hover:text-jessa-bataLight" :class="scrolled ? 'text-jessa-dark' : 'text-gray-200'">Profil</a>
                    <a href="#fasilitas" class="text-sm font-medium transition-colors hover:text-jessa-bataLight" :class="scrolled ? 'text-jessa-dark' : 'text-gray-200'">Fasilitas</a>
                    <a href="#kamar" class="text-sm font-medium transition-colors hover:text-jessa-bataLight" :class="scrolled ? 'text-jessa-dark' : 'text-gray-200'">Kamar</a>
                    <a href="#kontak" class="text-sm font-medium transition-colors hover:text-jessa-bataLight" :class="scrolled ? 'text-jessa-dark' : 'text-gray-200'">Kontak</a>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-5 py-2 rounded-full font-medium transition-all transform hover:scale-105 shadow-lg" :class="scrolled ? 'bg-jessa-bata text-white hover:bg-jessa-bataDark' : 'bg-jessa-cream text-jessa-bata hover:bg-white'">
                                Dasbor Saya
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2 rounded-full font-medium transition-all transform hover:scale-105 shadow-lg" :class="scrolled ? 'bg-jessa-bata text-white hover:bg-jessa-bataDark' : 'bg-jessa-cream text-jessa-bata hover:bg-white'">
                                Masuk / Login
                            </a>
                        @endauth
                    @endif
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="outline-none" :class="scrolled ? 'text-jessa-dark' : 'text-white'">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center relative overflow-hidden">
        <!-- Floating decorative elements -->
        <div class="absolute top-1/4 left-10 w-20 h-20 bg-jessa-bata rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute top-1/3 right-10 w-32 h-32 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full mt-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <span class="inline-block py-1 px-3 rounded-full bg-jessa-bata/20 text-jessa-cream border border-jessa-bata/30 text-sm font-semibold mb-6 backdrop-blur-sm">
                        📍 Lokasi Strategis di Pusat Kota
                    </span>
                    <h1 class="text-5xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                        Hunian Nyaman, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-jessa-bataLight to-yellow-400">Gaya Hidup Modern</span>
                    </h1>
                    <p class="text-lg text-gray-200 mb-8 max-w-lg leading-relaxed">
                        Jessa Kost menawarkan pengalaman menetap terbaik dengan fasilitas premium, keamanan 24 jam, dan lingkungan yang asri untuk mendukung produktivitas Anda.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#kamar" class="px-8 py-4 rounded-full bg-jessa-bata text-white font-bold text-center hover:bg-jessa-bataDark transition-all transform hover:-translate-y-1 shadow-[0_10px_20px_rgba(200,76,49,0.3)]">
                            Lihat Kamar Tersedia
                        </a>
                        <a href="#kontak" class="px-8 py-4 rounded-full bg-white/10 text-white font-bold text-center border border-white/30 hover:bg-white/20 transition-all backdrop-blur-md">
                            Hubungi Admin
                        </a>
                    </div>
                </div>

                <div class="hidden lg:block relative" data-aos="zoom-in-up" data-aos-duration="1200" data-aos-delay="200">
                    <div class="relative w-full h-[500px]">
                        <!-- Abstract Blob Masking Image -->
                        <div class="absolute inset-0 bg-jessa-bata blob-shape transform rotate-6 scale-105 opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1598928506311-c55ded91a20c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Jessa Kost Interior" class="absolute inset-0 w-full h-full object-cover blob-shape shadow-2xl border-4 border-white">

                        <!-- Floating Glass Card -->
                        <div class="absolute -bottom-6 -left-6 bg-white/80 backdrop-blur-lg p-5 rounded-2xl shadow-xl border border-white/50 animate-bounce" style="animation-duration: 3s;">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-xl">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-medium">Keamanan</p>
                                    <p class="text-lg font-bold text-jessa-dark">CCTV 24 Jam</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#profil" class="text-white opacity-70 hover:opacity-100 transition-opacity">
                <i class="fas fa-chevron-down text-2xl"></i>
            </a>
        </div>
    </section>

    <!-- Profil Section -->
    <section id="profil" class="py-24 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-jessa-creamDark rounded-full mix-blend-multiply opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="order-2 md:order-1 relative" data-aos="fade-right">
                    <div class="absolute inset-0 bg-jessa-bata/10 transform -rotate-3 rounded-3xl"></div>
                    <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Jessa Kost Building" class="relative rounded-3xl shadow-xl object-cover h-[450px] w-full transform transition hover:scale-[1.02] duration-500">
                </div>

                <div class="order-1 md:order-2" data-aos="fade-left">
                    <h4 class="text-jessa-bata font-bold tracking-wider uppercase text-sm mb-2">Tentang Kami</h4>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-jessa-dark mb-6 leading-tight">Mendefinisikan Ulang <br><span class="text-jessa-bata">Kenyamanan Kost</span></h2>

                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Berdiri sejak 2024, Jessa Kost hadir untuk menjawab kebutuhan hunian sementara yang tidak hanya sekadar tempat tidur, melainkan ruang yang mendukung gaya hidup produktif dan sehat.
                    </p>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Kami memadukan desain interior modern dengan warna <i>cream</i> yang menenangkan dan sentuhan <i>terracotta</i> yang hangat. Setiap sudut didesain khusus oleh tim profesional untuk memaksimalkan pencahayaan alami dan sirkulasi udara.
                    </p>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="border-l-4 border-jessa-bata pl-4">
                            <h3 class="text-3xl font-extrabold text-jessa-dark">30+</h3>
                            <p class="text-sm text-gray-500 font-medium">Kamar Eksklusif</p>
                        </div>
                        <div class="border-l-4 border-jessa-bata pl-4">
                            <h3 class="text-3xl font-extrabold text-jessa-dark">100%</h3>
                            <p class="text-sm text-gray-500 font-medium">Privasi Terjaga</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section id="fasilitas" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                <h4 class="text-jessa-bata font-bold tracking-wider uppercase text-sm mb-2">Keunggulan Kami</h4>
                <h2 class="text-3xl md:text-4xl font-extrabold text-jessa-dark mb-4">Fasilitas Premium</h2>
                <p class="text-gray-600">Nikmati kelengkapan fasilitas standar apartemen tanpa harus membayar mahal. Semua demi kenyamanan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Facility Item 1 -->
                <div class="bg-jessa-cream rounded-2xl p-8 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center text-2xl text-jessa-bata mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <h3 class="text-xl font-bold text-jessa-dark mb-3">High-Speed WiFi</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Koneksi internet tanpa batas hingga 100Mbps di seluruh area kamar dan ruang publik.</p>
                </div>

                <!-- Facility Item 2 -->
                <div class="bg-jessa-cream rounded-2xl p-8 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center text-2xl text-jessa-bata mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-snowflake"></i>
                    </div>
                    <h3 class="text-xl font-bold text-jessa-dark mb-3">AC & Smart TV</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Setiap kamar dilengkapi pendingin ruangan modern dan Smart TV 32 inch.</p>
                </div>

                <!-- Facility Item 3 -->
                <div class="bg-jessa-cream rounded-2xl p-8 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center text-2xl text-jessa-bata mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-bath"></i>
                    </div>
                    <h3 class="text-xl font-bold text-jessa-dark mb-3">Kamar Mandi Dalam</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Kamar mandi eksklusif dengan water heater, shower, dan kloset duduk Toto.</p>
                </div>

                <!-- Facility Item 4 -->
                <div class="bg-jessa-cream rounded-2xl p-8 transition-all duration-300 hover:shadow-xl hover:-translate-y-2 group border border-gray-100" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center text-2xl text-jessa-bata mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h3 class="text-xl font-bold text-jessa-dark mb-3">Cleaning Service</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Layanan pembersihan kamar gratis 1x seminggu atas permintaan penghuni.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kamar Tersedia Section -->
    <section id="kamar" class="py-24 relative bg-jessa-creamDark" x-data="{
        modalOpen: false,
        activeImage: '',
        roomData: {
            number: '',
            price: '',
            desc: '',
            cover: '',
            gallery: []
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12" data-aos="fade-in">
                <div class="max-w-2xl">
                    <h4 class="text-jessa-bata font-bold tracking-wider uppercase text-sm mb-2">Tipe Kamar</h4>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-jessa-dark mb-4">Informasi Kamar Kosong</h2>
                    <p class="text-gray-600">Update ketersediaan kamar secara real-time dari sistem kami.</p>
                </div>
            </div>

            @if(isset($featuredRooms) && $featuredRooms->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($featuredRooms as $index => $room)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 group cursor-pointer" data-aos="flip-left" data-aos-delay="{{ $index * 150 }}"
                        @click="modalOpen = true; roomData = {
                            number: '{{ $room->room_number }}',
                            price: '{{ number_format($room->price_per_month, 0, ',', '.') }}',
                            desc: '{{ htmlspecialchars($room->description ?? 'Full Furnished (Kasur, Lemari, Meja), Kamar Mandi Dalam, WiFi.', ENT_QUOTES) }}',
                            cover: '{{ $room->cover_image_path ? Storage::url($room->cover_image_path) : 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af' }}',
                            gallery: {{ json_encode($room->detail_image_paths ? array_map(fn($p) => Storage::url($p), $room->detail_image_paths) : []) }}
                        }; activeImage = roomData.cover;">

                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $room->cover_image_path ? Storage::url($room->cover_image_path) : 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af' }}" alt="Kamar {{ $room->room_number }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                            <div class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-md backdrop-blur-sm bg-opacity-90">
                                Tersedia
                            </div>
                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 to-transparent p-6 pt-12">
                                <h3 class="text-2xl font-bold text-white">Kamar {{ $room->room_number }}</h3>
                            </div>

                            <!-- Overlay CTA -->
                            <div class="absolute inset-0 bg-jessa-bata/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-sm">
                                <span class="bg-white text-jessa-bata font-bold px-6 py-2 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                    <i class="fas fa-search-plus mr-2"></i>Lihat Galeri
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-100">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Harga per bulan</p>
                                    <p class="text-2xl font-bold text-jessa-bata">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <button class="block w-full py-3 px-4 bg-jessa-cream text-jessa-bata font-bold text-center rounded-xl hover:bg-jessa-bata hover:text-white transition-colors">
                                Lihat Detail Kamar
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white p-12 rounded-3xl text-center shadow-sm border border-gray-200" data-aos="fade-up">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl text-gray-400">
                        <i class="fas fa-door-closed"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-jessa-dark mb-2">Mohon Maaf</h3>
                    <p class="text-gray-500 mb-6 max-w-md mx-auto">Saat ini seluruh kamar Jessa Kost sedang penuh / terisi. Silakan hubungi kami untuk masuk ke daftar tunggu (waiting list).</p>
                    <a href="#kontak" class="inline-block py-3 px-8 bg-jessa-bata text-white font-semibold rounded-full hover:bg-jessa-bataDark transition-colors shadow-lg">Hubungi Kami</a>
                </div>
            @endif
        </div>

        <!-- Room Detail Modal (AlpineJS) -->
        <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div x-show="modalOpen"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm transition-opacity"
                     @click="modalOpen = false"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="modalOpen"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle w-full max-w-4xl border border-gray-100">

                    <button @click="modalOpen = false" class="absolute top-4 right-4 z-10 w-10 h-10 bg-white/80 backdrop-blur-md rounded-full flex items-center justify-center text-gray-800 hover:bg-white hover:text-jessa-bata transition-colors shadow-sm">
                        <i class="fas fa-times"></i>
                    </button>

                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <!-- Left: Gallery -->
                        <div class="bg-gray-100 p-4 flex flex-col gap-4">
                            <!-- Main Image -->
                            <div class="rounded-2xl overflow-hidden aspect-[4/3] bg-gray-200 shadow-inner relative group">
                                <img :src="activeImage" class="w-full h-full object-cover transition-opacity duration-300">
                            </div>
                            <!-- Thumbnails -->
                            <div class="grid grid-cols-4 gap-2">
                                <div @click="activeImage = roomData.cover" class="aspect-square rounded-xl overflow-hidden cursor-pointer border-2 transition-colors" :class="activeImage === roomData.cover ? 'border-jessa-bata' : 'border-transparent hover:border-white/50 opacity-70 hover:opacity-100'">
                                    <img :src="roomData.cover" class="w-full h-full object-cover">
                                </div>
                                <template x-for="img in roomData.gallery" :key="img">
                                    <div @click="activeImage = img" class="aspect-square rounded-xl overflow-hidden cursor-pointer border-2 transition-colors" :class="activeImage === img ? 'border-jessa-bata' : 'border-transparent hover:border-white/50 opacity-70 hover:opacity-100'">
                                        <img :src="img" class="w-full h-full object-cover">
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Right: Details -->
                        <div class="p-8 flex flex-col justify-between">
                            <div>
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-bold mb-4 border border-green-100">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Tersedia
                                </div>
                                <h3 class="text-3xl font-black text-gray-900 mb-2" x-text="'Kamar ' + roomData.number"></h3>
                                <p class="text-jessa-bata font-bold text-2xl mb-6" x-text="'Rp ' + roomData.price + ' / bln'"></p>

                                <h4 class="font-bold text-gray-900 mb-2 border-b border-gray-100 pb-2">Deskripsi & Fasilitas</h4>
                                <p class="text-gray-600 text-sm leading-relaxed mb-6 whitespace-pre-line" x-text="roomData.desc"></p>

                                <ul class="space-y-3 mb-8">
                                    <li class="flex items-start text-sm text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i> Full Furnished (Kasur, Lemari, Meja)
                                    </li>
                                    <li class="flex items-start text-sm text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i> Kamar Mandi Dalam
                                    </li>
                                    <li class="flex items-start text-sm text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i> Listrik Token (Meteran Terpisah per Kamar)
                                    </li>
                                </ul>
                            </div>

                            <a href="#kontak" @click="modalOpen = false" class="block w-full py-4 bg-jessa-bata text-white font-bold text-center rounded-xl hover:bg-jessa-bataDark transition-colors shadow-lg shadow-jessa-bata/30 hover:-translate-y-0.5">
                                <i class="fab fa-whatsapp mr-2"></i> Hubungi Admin (Booking)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action / Contact -->
    <section id="kontak" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-jessa-dark rounded-3xl overflow-hidden shadow-2xl relative" data-aos="zoom-in">
                <!-- Abstract Design in CTA -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-jessa-bata rounded-full mix-blend-screen filter blur-3xl opacity-20"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-yellow-600 rounded-full mix-blend-screen filter blur-3xl opacity-20"></div>

                <div class="grid grid-cols-1 lg:grid-cols-2 relative z-10">
                    <div class="p-12 lg:p-16 flex flex-col justify-center">
                        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6">Tertarik Menjadi Bagian dari Jessa Kost?</h2>
                        <p class="text-gray-300 mb-10 text-lg">
                            Jangan ragu untuk bertanya atau mengatur jadwal survei lokasi. Tim admin kami siap melayani Anda dengan ramah.
                        </p>

                        <div class="space-y-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-jessa-bataLight mr-4">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-400">WhatsApp Admin</p>
                                    <p class="text-lg font-semibold text-white">+62 812-3456-7890</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-jessa-bataLight mr-4">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-400">Alamat Lengkap</p>
                                    <p class="text-lg font-semibold text-white">Jl. Mawar Merah No. 45, Jakarta Selatan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="h-64 lg:h-auto w-full relative">
                        <!-- Simulated Map Image -->
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Map Location" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-jessa-bata/20 mix-blend-multiply"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <a href="#" class="bg-white text-jessa-dark font-bold py-3 px-6 rounded-full shadow-xl hover:scale-105 transition-transform flex items-center">
                                <i class="fas fa-map-marked-alt text-jessa-bata mr-2"></i> Buka di Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-2">
                    <span class="text-2xl font-bold tracking-tight text-jessa-bata mb-4 block">
                        <i class="fas fa-leaf mr-2"></i>Jessa<span class="font-light text-jessa-dark">Kost</span>
                    </span>
                    <p class="text-gray-500 mb-6 max-w-sm leading-relaxed">
                        Kost modern inovatif dengan sistem manajemen cerdas terintegrasi, memberikan transparansi dan kenyamanan tanpa kompromi.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-jessa-cream text-jessa-bata rounded-full flex items-center justify-center hover:bg-jessa-bata hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-jessa-cream text-jessa-bata rounded-full flex items-center justify-center hover:bg-jessa-bata hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-jessa-cream text-jessa-bata rounded-full flex items-center justify-center hover:bg-jessa-bata hover:text-white transition-colors">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-jessa-dark mb-4">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="#profil" class="text-gray-500 hover:text-jessa-bata transition-colors text-sm">Profil Kost</a></li>
                        <li><a href="#fasilitas" class="text-gray-500 hover:text-jessa-bata transition-colors text-sm">Fasilitas</a></li>
                        <li><a href="#kamar" class="text-gray-500 hover:text-jessa-bata transition-colors text-sm">Cek Ketersediaan</a></li>
                        <li><a href="#kontak" class="text-gray-500 hover:text-jessa-bata transition-colors text-sm">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-jessa-dark mb-4">Akses Sistem</h4>
                    <ul class="space-y-3">
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="text-jessa-bata font-medium hover:underline text-sm">Dasbor Aplikasi</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-500 hover:text-jessa-bata transition-colors text-sm">Login Penghuni</a></li>
                            <li><a href="{{ route('login') }}" class="text-gray-500 hover:text-jessa-bata transition-colors text-sm">Login Admin/Owner</a></li>
                        @endauth
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} Jessa Kost Management System. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-gray-600 text-sm">Syarat & Ketentuan</a>
                    <a href="#" class="text-gray-400 hover:text-gray-600 text-sm">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Initialize AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                once: true,
                offset: 50,
                duration: 800,
                easing: 'ease-out-cubic',
            });
        });
    </script>
</body>
</html>
