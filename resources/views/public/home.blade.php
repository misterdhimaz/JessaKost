@extends('layouts.public', ['title' => 'Beranda - Kost 5 Menit ke UNSRI'])

@section('content')
    <!-- Hero Section: Premium White & Cream Balanced -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden bg-white selection:bg-jessa-maroon selection:text-white pt-10">
        <!-- Optimized Background Design for Mobile -->
        <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
            <!-- Orbs: simplified on mobile, animated on desktop -->
            <div class="absolute top-[-20%] left-[-10%] w-[300px] md:w-[700px] h-[300px] md:h-[700px] bg-jessa-cream/40 rounded-full opacity-70"></div>
            <div class="absolute top-[-10%] right-[-10%] w-[300px] md:w-[600px] h-[300px] md:h-[600px] bg-jessa-maroon/5 rounded-full opacity-50"></div>
            <div class="absolute bottom-[-20%] left-[20%] w-[300px] md:w-[800px] h-[300px] md:h-[800px] bg-red-100/30 rounded-full opacity-60 hidden md:block"></div>

            <!-- Dekorasi Pattern Dots Premium -->
            <svg class="absolute top-24 left-10 text-jessa-maroon/10 animate-float" style="animation-duration: 8s;" width="120" height="120" fill="none" viewBox="0 0 100 100">
                <pattern id="dots-hero" x="0" y="0" width="16" height="16" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="1.5" fill="currentColor"></circle>
                </pattern>
                <rect width="100" height="100" fill="url(#dots-hero)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 w-full pt-20 md:pt-16 pb-24 lg:pb-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-10 items-center">

                <!-- Teks & CTA (Kiri) -->
                <div class="lg:col-span-6" data-aos="fade-right" data-aos-duration="1000">
                    <!-- Premium Badge -->
                    <div class="inline-flex flex-wrap items-center p-1.5 pr-5 mb-8 rounded-full bg-white/80 backdrop-blur-md border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-[0_4px_25px_rgba(146,0,58,0.08)] transition-all gap-3 max-w-full">
                        <span class="px-4 py-1.5 rounded-full bg-jessa-maroon/10 text-jessa-maroon text-[10px] md:text-xs font-extrabold uppercase tracking-widest">Kost Ternyaman</span>
                        <span class="text-xs md:text-sm font-semibold text-gray-700 tracking-wide truncate flex items-center gap-1.5">
                            <span class="relative flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                            </span>
                            5 Menit ke Gerbang UNSRI
                        </span>
                    </div>

                    <h1 class="text-5xl md:text-6xl lg:text-[5rem] font-extrabold text-gray-900 leading-[1.05] mb-6 tracking-tighter relative">
                        <!-- Highlight Cream Effect -->
                        <span class="relative z-10 inline-block text-gray-900">
                            Kenyamanan
                            <span class="absolute bottom-3 left-0 w-full h-5 md:h-6 bg-jessa-cream/60 -z-10 transform -rotate-2 rounded-sm"></span>
                        </span>
                        <br class="hidden sm:block">
                        <span class="relative inline-block text-transparent bg-clip-text bg-gradient-to-r from-jessa-maroon to-red-600 mt-2">
                            Tanpa Batas.
                            <!-- Sparkle SVG -->
                            <svg class="absolute -top-6 -right-10 w-12 h-12 text-yellow-400 animate-pulse-slow drop-shadow-sm" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0l2.5 8.5L23 11l-8.5 2.5L12 22l-2.5-8.5L1 11l8.5-2.5z"/></svg>
                        </span>
                    </h1>

                    <p class="text-base md:text-lg lg:text-xl text-gray-600 mb-10 max-w-lg leading-relaxed font-medium bg-white/60 backdrop-blur-lg p-5 rounded-2xl border border-white shadow-[0_8px_30px_rgba(0,0,0,0.02)] relative">
                        <span class="absolute top-0 left-0 w-1 h-full bg-jessa-maroon rounded-l-2xl"></span>
                        Kombinasi sempurna antara fasilitas premium, privasi maksimal, dan estetika yang menenangkan. Kost idaman mahasiswa dengan fasilitas terlengkap.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('kamar') }}" class="px-8 py-4 rounded-full bg-jessa-maroon text-white font-extrabold text-center hover:bg-jessa-maroonDark transition-all duration-300 shadow-[0_10px_30px_rgba(146,0,58,0.25)] hover:shadow-[0_15px_40px_rgba(146,0,58,0.4)] hover:-translate-y-1 flex justify-center items-center group relative overflow-hidden">
                            <span class="relative z-10 flex items-center gap-2">Pesan Kamar Sekarang <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i></span>
                            <div class="absolute inset-0 bg-white/20 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500 z-0"></div>
                        </a>
                        <a href="{{ route('fasilitas') }}" class="px-8 py-4 rounded-full bg-white text-gray-800 font-bold text-center border border-gray-200 hover:border-jessa-maroon hover:text-jessa-maroon transition-all duration-300 flex justify-center items-center shadow-[0_5px_15px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_25px_rgba(146,0,58,0.1)] hover:-translate-y-1">
                            Eksplorasi Fasilitas
                        </a>
                    </div>
                </div>

                <!-- Foto Kost & Floating Cards (Kanan) -->
                <div class="lg:col-span-6 relative mt-12 lg:mt-0" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                    <!-- Lingkaran Hiasan Belakang Foto -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[100%] h-[100%] bg-gradient-to-tr from-jessa-cream/80 to-white rounded-full z-0 animate-pulse-slow blur-lg md:blur-2xl"></div>

                    <div class="relative z-10 flex justify-end items-center h-full sm:min-h-[550px]">

                        <!-- Main Image: Foto Kost Anda -->
                        <div class="w-full max-w-[420px] h-[480px] md:h-[580px] rounded-[2.5rem] shadow-[0_15px_40px_rgba(146,0,58,0.1)] md:shadow-[0_30px_60px_rgba(146,0,58,0.15)] overflow-hidden border-[6px] md:border-[8px] border-white relative group transform hover:-translate-y-1 transition-transform duration-500">
                            <div class="absolute inset-0 bg-jessa-maroon/10 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bangunan Jessa Kost" class="w-full h-full object-cover transform md:group-hover:scale-105 transition-transform duration-700 z-0">

                            <!-- Overlay Hiasan -->
                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent p-6 pt-24 z-20">
                                <span class="text-white font-extrabold text-xl tracking-wide drop-shadow-lg flex items-center gap-2">
                                    <i class="fas fa-building text-jessa-cream"></i> Gedung Utama Jessa Kost
                                </span>
                            </div>
                        </div>

                        <!-- Floating Image 2: Interior -->
                        <div class="absolute -left-2 md:-left-12 bottom-12 w-[180px] md:w-[260px] h-[180px] md:h-[260px] rounded-[1.5rem] md:rounded-[2rem] shadow-[0_10px_30px_rgba(0,0,0,0.1)] overflow-hidden border-[4px] md:border-[6px] border-white z-20 animate-float bg-white" style="animation-delay: 1s;">
                            <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Interior Kamar" class="w-full h-full object-cover">
                        </div>

                        <!-- Floating Card: Aman -->
                        <div class="absolute top-16 -left-4 md:-left-16 bg-white/95 md:bg-white/90 md:backdrop-blur-md px-4 md:px-5 py-3 md:py-4 rounded-2xl shadow-[0_10px_25px_rgba(0,0,0,0.1)] z-30 flex items-center gap-3 md:gap-4 border border-white animate-float" style="animation-delay: 2s;">
                            <div class="w-10 md:w-12 h-10 md:h-12 bg-gradient-to-br from-green-50 to-green-100 text-green-500 rounded-xl md:rounded-2xl flex items-center justify-center border border-green-200/50 shadow-inner">
                                <i class="fas fa-shield-check text-base md:text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-xs md:text-sm tracking-tight">Keamanan 24/7</h4>
                                <span class="text-[10px] md:text-xs text-gray-500 font-medium flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> CCTV Terpantau
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Unggulan Modern Cards -->
    <section class="py-20 md:py-28 relative z-20 bg-gray-50/50">
        <!-- Dekorasi Background -->
        <div class="absolute top-0 w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
        <svg class="absolute top-0 right-0 text-jessa-cream/30 w-full md:w-[600px] h-auto opacity-50 pointer-events-none" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,0 C50,100 100,50 100,0 L0,0 Z" fill="currentColor"/>
        </svg>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16 md:mb-20" data-aos="fade-up">
                <span class="text-jessa-maroon font-extrabold tracking-widest uppercase text-xs md:text-sm mb-4 block bg-white inline-block px-5 py-2 rounded-full shadow-sm border border-gray-100 text-jessa-maroon">Keunggulan Utama</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight relative inline-block">
                    Kenyamanan <span class="text-transparent bg-clip-text bg-gradient-to-r from-jessa-maroon to-red-500">Eksklusif</span>
                    <svg class="absolute -bottom-4 left-1/4 w-1/2 h-4 text-jessa-cream" viewBox="0 0 100 20" preserveAspectRatio="none"><path d="M0,10 Q50,20 100,10" stroke="currentColor" stroke-width="4" fill="none"/></svg>
                </h2>
                <p class="text-gray-500 text-base md:text-lg font-medium mt-4 leading-relaxed">Dari urusan perut, koneksi internet, hingga keamanan kendaraan. Jessa Kost menyediakan ekosistem terpadu terlengkap.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-[2rem] border border-gray-100 p-8 group hover:bg-gradient-to-br hover:from-white hover:to-red-50/30 transition-all duration-300 hover:-translate-y-2 shadow-[0_8px_30px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_40px_rgba(146,0,58,0.08)] relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-jessa-cream/30 rounded-full group-hover:scale-[2] transition-transform duration-700 ease-out z-0"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-red-50 border border-red-100 shadow-sm rounded-2xl flex items-center justify-center text-2xl mb-6 text-jessa-maroon group-hover:bg-jessa-maroon group-hover:text-white group-hover:border-jessa-maroon group-hover:rotate-12 transition-all duration-300">
                            <i class="fas fa-store"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-3 group-hover:text-jessa-maroon transition-colors">Warung Makan</h3>
                        <p class="text-gray-500 leading-relaxed font-medium mb-5 text-sm">Akses kuliner dan kebutuhan harian mudah.</p>
                        <div class="inline-flex items-center gap-2 bg-gray-50 px-3.5 py-2 rounded-xl border border-gray-100 shadow-sm">
                            <i class="fas fa-gift text-jessa-maroon"></i>
                            <span class="text-gray-700 font-bold text-xs">Es Teh Gratis Tiap Jumat</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-[2rem] border border-gray-100 p-8 group hover:bg-gradient-to-br hover:from-white hover:to-blue-50/30 transition-all duration-300 hover:-translate-y-2 shadow-[0_8px_30px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_40px_rgba(59,130,246,0.08)] relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-blue-50/60 rounded-full group-hover:scale-[2] transition-transform duration-700 ease-out z-0"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-blue-50 border border-blue-100 shadow-sm rounded-2xl flex items-center justify-center text-2xl mb-6 text-blue-600 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 group-hover:rotate-12 transition-all duration-300">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">Koneksi Internet</h3>
                        <p class="text-gray-500 leading-relaxed font-medium text-sm">Internet dedicated yang andal. Lancar untuk kelas online, atau sekadar hiburan tanpa buffering.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-[2rem] border border-gray-100 p-8 group hover:bg-gradient-to-br hover:from-white hover:to-green-50/30 transition-all duration-300 hover:-translate-y-2 shadow-[0_8px_30px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_40px_rgba(34,197,94,0.08)] relative overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-green-50/60 rounded-full group-hover:scale-[2] transition-transform duration-700 ease-out z-0"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-green-50 border border-green-100 shadow-sm rounded-2xl flex items-center justify-center text-2xl mb-6 text-green-600 group-hover:bg-green-600 group-hover:text-white group-hover:border-green-600 group-hover:rotate-12 transition-all duration-300">
                            <i class="fas fa-motorcycle"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-3 group-hover:text-green-600 transition-colors">Parkir Lega</h3>
                        <p class="text-gray-500 leading-relaxed font-medium text-sm">Area parkir kanopi lega dirancang agar Anda bisa mengeluarkan motor tanpa harus repot.</p>
                    </div>
                </div>

                <!-- Card 4: Air & Sampah -->
                <div class="bg-white rounded-[2rem] border border-gray-100 p-8 group hover:bg-gradient-to-br hover:from-white hover:to-cyan-50/30 transition-all duration-300 hover:-translate-y-2 shadow-[0_8px_30px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_40px_rgba(6,182,212,0.08)] relative overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-cyan-50/60 rounded-full group-hover:scale-[2] transition-transform duration-700 ease-out z-0"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-cyan-50 border border-cyan-100 shadow-sm rounded-2xl flex items-center justify-center text-2xl mb-6 text-cyan-500 group-hover:bg-cyan-500 group-hover:text-white group-hover:border-cyan-500 group-hover:rotate-12 transition-all duration-300">
                            <i class="fas fa-faucet-drip"></i>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-3 group-hover:text-cyan-600 transition-colors">Air & Sampah Gratis</h3>
                        <p class="text-gray-500 leading-relaxed font-medium text-sm">Sudah termasuk fasilitas air bersih 24 jam dan pengelolaan sampah rutin setiap harinya.</p>
                    </div>
                </div>
            </div>

            <div class="mt-14 md:mt-20 text-center" data-aos="fade-up">
                <a href="{{ route('fasilitas') }}" class="inline-flex items-center gap-3 text-jessa-maroon font-bold bg-white border-2 border-jessa-cream hover:border-jessa-maroon hover:bg-jessa-maroon hover:text-white py-4 px-10 rounded-full transition-all duration-300 shadow-md hover:shadow-[0_10px_25px_rgba(146,0,58,0.25)] group">
                    Eksplorasi Semua Fasilitas <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Premium Maroon CTA Section -->
    <section class="py-16 md:py-24 relative mx-4 sm:mx-8 mb-16 md:mb-20 rounded-[2rem] md:rounded-[3rem] overflow-hidden bg-gradient-to-br from-white to-gray-50 border border-gray-200 shadow-[0_20px_50px_rgba(0,0,0,0.06)]" data-aos="fade-up">

        <!-- Hiasan Geometris CTA (Premium Abstract) -->
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-gradient-to-bl from-jessa-cream/50 to-transparent rounded-full blur-[80px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-gradient-to-tr from-jessa-maroon/10 to-transparent rounded-full blur-[80px] pointer-events-none"></div>

        <!-- Abstract Line Pattern -->
        <svg class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid-pattern)" />
        </svg>

        <div class="max-w-4xl mx-auto px-6 md:px-8 relative z-10 text-center py-6 md:py-10">
            <!-- Promo Badge -->
            <div class="inline-flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-green-400 to-green-500 text-white rounded-full text-xs font-extrabold mb-8 shadow-[0_4px_15px_rgba(34,197,94,0.3)] uppercase tracking-widest">
                <i class="fas fa-tag"></i> Promo Mahasiswa UNSRI
            </div>

            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tighter">
                Buka Pintu <span class="text-transparent bg-clip-text bg-gradient-to-r from-jessa-maroon to-red-600">Kenyamanan</span> Baru.
            </h2>

            <p class="text-gray-500 text-base md:text-lg mb-10 max-w-2xl mx-auto font-medium leading-relaxed bg-white/70 backdrop-blur-md p-5 rounded-2xl shadow-sm border border-white">
                Persiapkan Kartu Pengenal Mahasiswa (KPM) Anda. Klaim penawaran eksklusif kami melalui WhatsApp dan amankan kamar Anda hari ini.
            </p>

            <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex flex-wrap justify-center items-center gap-3 bg-gray-900 text-white font-extrabold py-4 px-10 md:px-12 rounded-full hover:bg-jessa-maroon transition-all duration-300 shadow-[0_10px_25px_rgba(0,0,0,0.15)] hover:-translate-y-1 hover:shadow-[0_15px_35px_rgba(146,0,58,0.3)] text-sm md:text-base group">
                <div class="relative flex h-5 w-5 mr-1">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <i class="fab fa-whatsapp relative inline-flex text-xl text-green-400 group-hover:text-white transition-colors"></i>
                </div>
                Hubungi Admin Kami
            </a>
        </div>
    </section>

@endsection
