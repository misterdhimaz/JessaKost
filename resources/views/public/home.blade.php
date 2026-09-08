@extends('layouts.public', ['title' => 'Beranda - Kost 5 Menit ke UNSRI'])

@section('content')
    <!-- Hero Section: Premium White & Cream Balanced -->
    <section class="min-h-[90vh] flex items-center relative mt-0 mx-0 sm:mx-4 md:mx-6 rounded-b-[2.5rem] sm:rounded-b-[3.5rem] md:rounded-b-[4rem] overflow-hidden bg-gradient-to-br from-white via-jessa-cream/40 to-white border-t-4 border-jessa-maroon shadow-[0_15px_50px_rgba(146,0,58,0.05)] border-b border-jessa-cream/50">

        <!-- Dekorasi Orbs & Blobs -->
        <div class="absolute top-0 right-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-jessa-cream rounded-full filter blur-[60px] opacity-80 animate-pulse-slow"></div>
            <div class="absolute bottom-10 left-10 w-72 h-72 bg-jessa-maroon/5 rounded-full filter blur-[50px] animate-float"></div>

            <!-- Dekorasi Pattern Dots Tambahan -->
            <svg class="absolute top-20 left-10 text-jessa-maroon/10 animate-float" width="100" height="100" fill="none" viewBox="0 0 100 100">
                <pattern id="dots-hero" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                </pattern>
                <rect width="100" height="100" fill="url(#dots-hero)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 w-full pt-16 md:pt-10 pb-20 lg:pb-0">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                <!-- Teks & CTA (Kiri) -->
                <div class="lg:col-span-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-flex flex-wrap items-center p-1 pr-4 md:pr-5 mb-8 rounded-full bg-white border border-jessa-cream shadow-sm hover:shadow-md transition-shadow gap-2 md:gap-4 max-w-full">
                        <span class="px-3 md:px-4 py-1.5 rounded-full bg-jessa-cream text-jessa-maroon text-[10px] md:text-xs font-bold uppercase tracking-widest">Premium Kost</span>
                        <span class="text-xs md:text-sm font-semibold text-gray-700 tracking-wide truncate">📍 5 Menit ke Gerbang UNSRI</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl lg:text-[4.5rem] font-extrabold text-gray-900 leading-[1.1] mb-6 tracking-tighter relative">
                        <!-- Highlight Cream Effect -->
                        <span class="relative z-10 inline-block">
                            Kenyamanan
                            <span class="absolute bottom-2 left-0 w-full h-4 md:h-6 bg-jessa-cream -z-10 transform -rotate-1"></span>
                        </span>
                        <br class="hidden sm:block">
                        <span class="text-jessa-maroon relative">
                            Tanpa Batas.
                            <!-- Sparkle SVG -->
                            <svg class="absolute -top-6 -right-8 w-10 h-10 text-yellow-400 animate-pulse-slow" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0l2.5 8.5L23 11l-8.5 2.5L12 22l-2.5-8.5L1 11l8.5-2.5z"/></svg>
                        </span>
                    </h1>

                    <p class="text-base md:text-lg lg:text-xl text-gray-600 mb-10 max-w-lg leading-relaxed font-medium bg-white/50 backdrop-blur-sm p-4 rounded-2xl border border-white">
                        Kombinasi sempurna antara fasilitas premium, privasi maksimal, dan estetika yang menenangkan. Kost idaman mahasiswa dengan fasilitas terlengkap.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('kamar') }}" class="px-8 py-4 rounded-full bg-jessa-maroon text-white font-extrabold text-center hover:bg-jessa-maroonDark transition-all duration-300 shadow-[0_8px_20px_rgba(146,0,58,0.3)] hover:shadow-[0_10px_25px_rgba(146,0,58,0.4)] hover:-translate-y-1 flex justify-center items-center group relative overflow-hidden">
                            <span class="relative z-10">Pesan Kamar Sekarang</span>
                            <div class="absolute inset-0 bg-white/20 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500 z-0"></div>
                        </a>
                        <a href="{{ route('fasilitas') }}" class="px-8 py-4 rounded-full bg-white text-jessa-maroon font-bold text-center border-2 border-jessa-cream hover:border-jessa-maroon hover:bg-jessa-cream/20 transition-all duration-300 flex justify-center items-center shadow-sm">
                            Eksplorasi Fasilitas
                        </a>
                    </div>
                </div>

                <!-- Foto Kost & Floating Cards (Kanan) -->
                <div class="lg:col-span-6 relative" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                    <!-- Lingkaran Hiasan Belakang Foto -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[110%] h-[110%] bg-jessa-cream/60 rounded-full z-0 animate-pulse-slow blur-xl"></div>

                    <div class="relative z-10 flex justify-end items-center h-full sm:min-h-[500px]">
                        <!-- Main Image: Foto Kost Anda -->
                        <!-- UBAH FOTO INI DENGAN FOTO KOST ASLI ANDA -->
                        <div class="w-full max-w-[400px] h-[450px] md:h-[550px] rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.1)] overflow-hidden border-[8px] border-white relative group">
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bangunan Jessa Kost" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">

                            <!-- Overlay Hiasan -->
                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/60 to-transparent p-6 pt-20">
                                <span class="text-white font-extrabold text-xl tracking-wide drop-shadow-md">Gedung Utama Jessa Kost</span>
                            </div>
                        </div>

                        <!-- Floating Image 2: Interior -->
                        <div class="absolute -left-4 md:-left-16 bottom-10 w-[200px] md:w-[250px] h-[200px] md:h-[250px] rounded-3xl shadow-2xl overflow-hidden border-[6px] border-jessa-cream z-20 animate-float" style="animation-delay: 1s;">
                            <!-- UBAH FOTO INI DENGAN FOTO KAMAR ASLI ANDA -->
                            <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Interior Kamar" class="w-full h-full object-cover">
                        </div>

                        <!-- Floating Card: Aman -->
                        <div class="absolute top-10 -left-6 md:-left-10 bg-white/95 backdrop-blur-md px-5 py-4 rounded-2xl shadow-xl z-30 flex items-center gap-4 border border-jessa-cream animate-float" style="animation-delay: 2s;">
                            <div class="w-10 h-10 bg-green-50 text-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-shield-check"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm">Keamanan 24/7</h4>
                                <span class="text-xs text-gray-500 font-medium">Smart Lock & CCTV</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Unggulan Modern Cards -->
    <section class="py-16 md:py-24 relative z-20 bg-white">
        <!-- Dekorasi Background -->
        <svg class="absolute top-0 right-0 text-jessa-cream/40" width="400" height="400" fill="none" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,0 C50,100 100,50 100,0 L0,0 Z" fill="currentColor"/>
        </svg>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16 md:mb-20" data-aos="fade-up">
                <span class="text-jessa-maroon font-extrabold tracking-widest uppercase text-xs md:text-sm mb-3 block bg-jessa-cream/50 inline-block px-5 py-1.5 rounded-full border border-jessa-maroon/10">Keunggulan Utama</span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight relative inline-block">
                    Kenyamanan <span class="text-jessa-maroon font-light">Eksklusif</span>
                    <svg class="absolute -bottom-4 left-1/4 w-1/2 h-4 text-jessa-cream" viewBox="0 0 100 20" preserveAspectRatio="none"><path d="M0,10 Q50,20 100,10" stroke="currentColor" stroke-width="4" fill="none"/></svg>
                </h2>
                <p class="text-gray-500 text-base md:text-lg font-medium mt-4">Dari urusan perut, koneksi internet, hingga keamanan kendaraan. Jessa Kost menyediakan ekosistem terpadu terlengkap.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-[2rem] border border-jessa-cream p-8 group hover:bg-jessa-cream/10 transition-all duration-300 hover:-translate-y-2 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgba(146,0,58,0.08)] relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-jessa-cream/30 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out z-0"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white border-2 border-jessa-cream shadow-sm rounded-2xl flex items-center justify-center text-3xl mb-6 text-jessa-maroon group-hover:bg-jessa-maroon group-hover:text-white group-hover:border-jessa-maroon transition-all duration-300">
                            <i class="fas fa-store"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-jessa-maroon transition-colors">Warung & Rumah Makan</h3>
                        <p class="text-gray-500 leading-relaxed font-medium mb-4 text-sm">Akses kuliner rumahan dan kebutuhan harian tanpa perlu keluar pagar.</p>
                        <div class="inline-block bg-white px-3 py-1.5 rounded-lg border border-jessa-maroon/10 shadow-sm">
                            <p class="text-jessa-maroon font-bold text-xs"><i class="fas fa-gift mr-1 text-jessa-maroon/70"></i> Es Teh Gratis Tiap Jumat</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-[2rem] border border-jessa-cream p-8 group hover:bg-blue-50/50 transition-all duration-300 hover:-translate-y-2 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgba(59,130,246,0.08)] relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out z-0"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white border-2 border-blue-100 shadow-sm rounded-2xl flex items-center justify-center text-3xl mb-6 text-blue-500 group-hover:bg-blue-500 group-hover:text-white group-hover:border-blue-500 transition-all duration-300">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">Koneksi Tanpa Batas</h3>
                        <p class="text-gray-500 leading-relaxed font-medium text-sm">Internet dedicated yang andal. Lancar untuk kelas online, download jurnal, atau sekadar hiburan.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-[2rem] border border-jessa-cream p-8 group hover:bg-green-50/50 transition-all duration-300 hover:-translate-y-2 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgba(34,197,94,0.08)] relative overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-green-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out z-0"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white border-2 border-green-100 shadow-sm rounded-2xl flex items-center justify-center text-3xl mb-6 text-green-500 group-hover:bg-green-500 group-hover:text-white group-hover:border-green-500 transition-all duration-300">
                            <i class="fas fa-motorcycle"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors">Parkir Motor Ideal</h3>
                        <p class="text-gray-500 leading-relaxed font-medium text-sm">Area parkir kanopi lega yang dirancang agar Anda bisa mengeluarkan motor tanpa harus menggeser puluhan motor lainnya.</p>
                    </div>
                </div>
            </div>

            <div class="mt-12 md:mt-16 text-center" data-aos="fade-up">
                <a href="{{ route('fasilitas') }}" class="inline-flex items-center gap-3 text-jessa-maroon font-bold bg-jessa-cream/30 border border-jessa-cream hover:bg-jessa-maroon hover:text-white py-3 md:py-4 px-8 rounded-full transition-all shadow-sm hover:shadow-[0_8px_20px_rgba(146,0,58,0.2)]">
                    Eksplorasi Semua Fasilitas <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Thin Maroon CTA Section (With Cream & Ornaments) -->
    <section class="py-16 md:py-24 relative mx-4 sm:mx-8 mb-16 md:mb-20 rounded-[2rem] md:rounded-[3rem] overflow-hidden bg-gradient-to-r from-white via-jessa-cream/20 to-white border-[6px] border-jessa-cream shadow-[0_20px_60px_rgba(0,0,0,0.05)]" data-aos="fade-up">
        <!-- Hiasan Geometris CTA -->
        <div class="absolute top-0 right-0 w-32 md:w-64 h-32 md:h-64 bg-jessa-maroon/10 rounded-full blur-[40px] md:blur-[60px]"></div>
        <div class="absolute bottom-0 left-0 w-32 md:w-64 h-32 md:h-64 bg-jessa-cream rounded-full blur-[40px] md:blur-[60px]"></div>
        <svg class="absolute top-10 right-20 text-jessa-maroon/10 animate-pulse-slow" width="60" height="60" viewBox="0 0 100 100" fill="currentColor">
            <circle cx="50" cy="50" r="10" />
            <circle cx="20" cy="20" r="6" />
            <circle cx="80" cy="20" r="6" />
            <circle cx="20" cy="80" r="6" />
            <circle cx="80" cy="80" r="6" />
        </svg>

        <div class="max-w-4xl mx-auto px-6 md:px-8 relative z-10 text-center py-6 md:py-10">
            <span class="inline-block px-5 py-2 bg-green-500 text-white rounded-full text-xs font-extrabold mb-6 shadow-md uppercase tracking-widest border border-green-400">Promo Mahasiswa UNSRI</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tighter">
                Buka Pintu <span class="text-jessa-maroon">Kenyamanan</span> Baru.
            </h2>
            <p class="text-gray-500 text-base md:text-lg mb-10 max-w-2xl mx-auto font-medium leading-relaxed bg-white/50 backdrop-blur-sm p-4 rounded-xl">Persiapkan Kartu Tanda Mahasiswa (KTM) Anda. Klaim penawaran eksklusif kami melalui WhatsApp dan amankan kamar Anda hari ini.</p>

            <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex flex-wrap justify-center items-center gap-3 bg-white text-gray-800 font-extrabold py-4 px-10 md:px-12 rounded-full hover:bg-gray-50 transition-all shadow-[0_8px_20px_rgba(0,0,0,0.06)] border-2 border-jessa-cream hover:border-green-400 hover:text-green-600 hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(34,197,94,0.2)] text-sm md:text-base group">
                <i class="fab fa-whatsapp text-xl md:text-2xl text-green-500 group-hover:scale-110 transition-transform"></i> Hubungi Admin Kami
            </a>
        </div>
    </section>

@endsection
