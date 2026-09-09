@extends('layouts.public', ['title' => 'Fasilitas Terlengkap'])

@section('content')
    <!-- Page Hero -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 bg-jessa-cream overflow-hidden rounded-b-[2rem] sm:rounded-b-[3rem] border-b border-jessa-maroon/10 mb-10">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center opacity-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-jessa-cream via-jessa-cream/80 to-transparent pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-jessa-maroon/10 text-jessa-maroon font-bold text-xs uppercase tracking-widest mb-4 border border-jessa-maroon/20" data-aos="fade-up">Eksplorasi Jessa Kost</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight" data-aos="fade-up" data-aos-delay="100">Fasilitas <span class="text-jessa-maroon">Terlengkap</span></h1>
            <p class="text-gray-700 text-lg md:text-xl font-medium max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">Ekosistem lengkap yang menjamin kenyamanan aktivitas keseharian Anda, di dalam maupun di luar kamar.</p>
        </div>
    </section>

    <section class="py-10 pb-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Facility 1 -->
                <div class="modern-card p-8 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-white shadow-sm border border-gray-100 rounded-2xl flex items-center justify-center text-2xl text-jessa-maroon mb-6 group-hover:bg-jessa-maroon group-hover:text-white transition-all duration-300">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Rumah Makan Prasmanan</h3>
                    <p class="text-gray-600 text-base leading-relaxed font-medium mb-4">Akses mudah makanan rumahan higienis yang ramah kantong mahasiswa.</p>
                    <div class="inline-block bg-yellow-100 border border-yellow-200 px-3 py-1.5 rounded-lg">
                        <p class="text-yellow-700 font-bold text-xs"><i class="fas fa-gift mr-1 text-yellow-500"></i> Es Teh Gratis Tiap Jumat</p>
                    </div>
                </div>

                <!-- Facility 2 -->
                <div class="modern-card p-8 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-white shadow-sm border border-gray-100 rounded-2xl flex items-center justify-center text-2xl text-blue-500 mb-6 group-hover:bg-blue-500 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-store"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Warung Sembako Terpadu</h3>
                    <p class="text-gray-600 text-base leading-relaxed font-medium">Beli sabun, sampo, atau cemilan malam hari tanpa harus melangkah keluar gerbang kost. Semua ada di dalam area kost.</p>
                </div>

                <!-- Facility 3 -->
                <div class="modern-card p-8 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-white shadow-sm border border-gray-100 rounded-2xl flex items-center justify-center text-2xl text-purple-500 mb-6 group-hover:bg-purple-500 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Konektivitas Maksimal</h3>
                    <p class="text-gray-600 text-base leading-relaxed font-medium">Infrastruktur WiFi berkecepatan tinggi yang merata di setiap sudut area kost. Streaming dan zoom meeting tanpa hambatan.</p>
                </div>

                <!-- Facility 4 -->
                <div class="modern-card p-8 group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-white shadow-sm border border-gray-100 rounded-2xl flex items-center justify-center text-2xl text-teal-500 mb-6 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-bed"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Kamar Siap Huni</h3>
                    <p class="text-gray-600 text-base leading-relaxed font-medium">Dilengkapi ranjang nyaman standar hotel, lemari pakaian 2 pintu, dan set meja kerja. Anda hanya perlu membawa koper pakaian.</p>
                </div>

                <!-- Facility 5 -->
                <div class="modern-card p-8 group" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-16 h-16 bg-white shadow-sm border border-gray-100 rounded-2xl flex items-center justify-center text-2xl text-green-500 mb-6 group-hover:bg-green-500 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Parkir Motor Ideal</h3>
                    <p class="text-gray-600 text-base leading-relaxed font-medium">Area parkir kanopi luas dan terstruktur. Dilengkapi pengawasan CCTV 24 jam penuh untuk ketenangan pikiran saat Anda tidur.</p>
                </div>

                <!-- Facility 6 -->
                <div class="modern-card p-8 group" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-16 h-16 bg-white shadow-sm border border-gray-100 rounded-2xl flex items-center justify-center text-2xl text-sky-500 mb-6 group-hover:bg-sky-500 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Perawatan Rutin</h3>
                    <p class="text-gray-600 text-base leading-relaxed font-medium">Layanan kebersihan area publik dan perawatan fasilitas terjadwal oleh tim khusus kami. Anda fokus kuliah, kami urus sisanya.</p>
                </div>

                <!-- Facility 7 -->
                <div class="modern-card p-8 group" data-aos="fade-up" data-aos-delay="700">
                    <div class="w-16 h-16 bg-white shadow-sm border border-gray-100 rounded-2xl flex items-center justify-center text-2xl text-cyan-500 mb-6 group-hover:bg-cyan-500 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-faucet-drip"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Air Bersih & Sampah Gratis</h3>
                    <p class="text-gray-600 text-base leading-relaxed font-medium">Fasilitas air bersih mengalir 24 jam penuh tanpa hambatan, serta pengelolaan dan pembuangan sampah rutin setiap hari secara cuma-cuma.</p>
                </div>

            </div>
        </div>
    </section>
@endsection
