@extends('layouts.public', ['title' => 'Beranda - Kost 5 Menit ke UNSRI'])

@section('content')
    <!-- Hero Section Clean & Cream Primary -->
    <section class="min-h-[85vh] flex items-center relative mt-0 rounded-b-[4rem] overflow-hidden mx-2 sm:mx-4 bg-jessa-cream border-t-4 border-jessa-maroon shadow-[0_10px_40px_rgba(0,0,0,0.05)] border-b border-gray-100">

        <!-- Subtle Background Pattern -->
        <div class="absolute inset-0 bg-white/40 z-0 mix-blend-overlay"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full z-0 overflow-hidden hidden lg:block">
            <div class="absolute inset-0 bg-gradient-to-l from-transparent via-jessa-cream to-jessa-cream z-10"></div>
            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Interior" class="w-full h-full object-cover opacity-30 mix-blend-multiply">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full pt-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-up" data-aos-duration="1000">
                    <div class="inline-flex items-center p-1 pr-5 mb-8 rounded-full bg-white border border-jessa-maroon/20 shadow-sm hover:shadow-md transition-shadow">
                        <span class="px-4 py-1.5 rounded-full bg-jessa-maroon/10 text-jessa-maroon text-xs font-bold mr-4 uppercase tracking-widest border border-jessa-maroon/10">Lokasi Strategis</span>
                        <span class="text-sm font-semibold text-gray-700 tracking-wide">🚶 5 Menit ke Gerbang UNSRI</span>
                    </div>

                    <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-tight mb-6 tracking-tighter">
                        Kenyamanan <br>
                        <span class="text-jessa-maroon">Tanpa Batas.</span>
                    </h1>

                    <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-lg leading-relaxed font-medium">
                        Kombinasi sempurna antara fasilitas premium, privasi maksimal, dan estetika yang menenangkan. Jessa Kost dirancang untuk menunjang prestasimu.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('kamar') }}" class="px-8 py-4 rounded-full bg-white text-jessa-maroon font-bold text-center border-2 border-jessa-maroon hover:bg-jessa-maroon hover:text-white transition-all duration-300 shadow-md hover:shadow-lg flex justify-center items-center group">
                            Cek Kamar Kosong
                            <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform text-sm"></i>
                        </a>
                        <a href="{{ route('fasilitas') }}" class="px-8 py-4 rounded-full bg-transparent text-gray-700 font-bold text-center border-2 border-transparent hover:border-gray-200 hover:bg-white/50 transition-all duration-300 flex justify-center items-center">
                            Jelajahi Fasilitas
                        </a>
                    </div>
                </div>

                <!-- Floating Modern Cards in Hero -->
                <div class="hidden lg:block relative h-[500px]" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                    <!-- Top Card -->
                    <div class="absolute top-10 right-10 w-[280px] modern-card p-6 z-20">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-jessa-maroon shadow-sm shrink-0">
                                <i class="fas fa-graduation-cap text-lg"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 text-sm">Dekat Kampus</h3>
                        </div>
                        <p class="text-xs text-gray-500 font-medium leading-relaxed">Hemat ongkos & waktu, jalan kaki cuma 5 menit ke gerbang utama UNSRI.</p>
                    </div>

                    <!-- Main Image Card -->
                    <div class="absolute top-24 left-10 w-[320px] h-[220px] rounded-3xl shadow-2xl overflow-hidden z-10 border-4 border-white hover-lift">
                        <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Room" class="w-full h-full object-cover">
                    </div>

                    <!-- Bottom Card -->
                    <div class="absolute bottom-10 right-20 w-[280px] modern-card p-6 z-30">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-green-500 shadow-sm shrink-0">
                                <i class="fas fa-shield-check text-lg"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 text-sm">Aman & Tenang</h3>
                        </div>
                        <p class="text-xs text-gray-500 font-medium leading-relaxed">Keamanan terjamin dengan CCTV 24/7 dan smart door lock.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Unggulan Modern Cards -->
    <section class="py-24 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-20" data-aos="fade-up">
                <span class="text-jessa-maroon font-extrabold tracking-widest uppercase text-sm mb-2 block">Keunggulan Utama</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight">Kenyamanan <span class="text-jessa-maroon font-light">Eksklusif</span></h2>
                <p class="text-gray-600 text-lg font-medium">Dari urusan perut, koneksi internet, hingga keamanan kendaraan. Jessa Kost menyediakan ekosistem putih-cream terlengkap.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="modern-card p-8 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-jessa-cream border border-gray-100 rounded-2xl flex items-center justify-center text-2xl mb-6 text-jessa-maroon group-hover:bg-jessa-maroon group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="fas fa-store"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-jessa-maroon transition-colors">Warung & Rumah Makan</h3>
                    <p class="text-gray-500 leading-relaxed font-medium mb-4 text-sm">Akses kuliner rumahan dan kebutuhan harian tanpa perlu keluar pagar.</p>
                    <div class="inline-block bg-[#FEFCF5] px-3 py-1.5 rounded-lg border border-yellow-200/50">
                        <p class="text-yellow-700 font-bold text-xs"><i class="fas fa-gift mr-1 text-yellow-500"></i> Es Teh Gratis Tiap Jumat</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="modern-card p-8 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center text-2xl mb-6 text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">Koneksi Tanpa Batas</h3>
                    <p class="text-gray-500 leading-relaxed font-medium text-sm">Internet dedicated yang andal. Lancar untuk kelas online, download jurnal, atau sekadar hiburan.</p>
                </div>

                <!-- Card 3 -->
                <div class="modern-card p-8 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 bg-green-50 border border-green-100 rounded-2xl flex items-center justify-center text-2xl mb-6 text-green-500 group-hover:bg-green-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors">Parkir Motor Ideal</h3>
                    <p class="text-gray-500 leading-relaxed font-medium text-sm">Area parkir kanopi lega yang dirancang agar Anda bisa mengeluarkan motor tanpa harus menggeser puluhan motor lainnya.</p>
                </div>
            </div>

            <div class="mt-16 text-center" data-aos="fade-up">
                <a href="{{ route('fasilitas') }}" class="inline-flex items-center gap-3 text-jessa-maroon font-bold bg-white border border-gray-200 hover:border-jessa-maroon py-3 px-8 rounded-full transition-all shadow-sm hover:shadow-md">
                    Eksplorasi Semua Fasilitas <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Thin Maroon CTA Section -->
    <section class="py-20 relative mx-4 sm:mx-8 mb-20 rounded-[3rem] overflow-hidden bg-white border-t-[6px] border-jessa-maroon shadow-xl" data-aos="fade-up">
        <div class="absolute inset-0 bg-jessa-cream/20 mix-blend-multiply"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-jessa-maroon/5 rounded-full blur-[60px]"></div>

        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center py-10">
            <span class="inline-block px-4 py-1.5 bg-green-100 text-green-700 rounded-full text-xs font-extrabold mb-6 shadow-sm uppercase tracking-widest border border-green-200">Promo Mahasiswa UNSRI</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tighter">Buka Pintu Kenyamanan Baru.</h2>
            <p class="text-gray-500 text-lg mb-10 max-w-2xl mx-auto font-medium leading-relaxed">Persiapkan Kartu Tanda Mahasiswa (KTM) Anda. Klaim penawaran eksklusif kami melalui WhatsApp dan amankan kamar Anda hari ini.</p>

            <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-3 bg-white text-gray-900 font-extrabold py-4 px-10 rounded-full hover:bg-gray-50 transition-all shadow-md border border-gray-200 hover:border-green-500 hover:text-green-600 hover:-translate-y-1 hover:scale-105 text-base">
                <i class="fab fa-whatsapp text-xl text-green-500"></i> Hubungi Admin Kami
            </a>
        </div>
    </section>

@endsection
