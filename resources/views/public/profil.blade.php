@extends('layouts.public', ['title' => 'Profil Kami'])

@section('content')
    <!-- Page Hero -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 bg-jessa-cream overflow-hidden rounded-b-[2rem] sm:rounded-b-[3rem] border-b border-jessa-maroon/10 mb-10">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center opacity-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-jessa-cream via-jessa-cream/80 to-transparent pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-jessa-maroon/10 text-jessa-maroon font-bold text-xs uppercase tracking-widest mb-4 border border-jessa-maroon/20" data-aos="fade-up">Tentang Kami</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight" data-aos="fade-up" data-aos-delay="100">Profil <span class="text-jessa-maroon">Jessa Kost</span></h1>
            <p class="text-gray-700 text-lg md:text-xl font-medium max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">Menyediakan hunian sementara yang mendukung gaya hidup produktif mahasiswa dengan perpaduan kenyamanan modern dan lokasi strategis.</p>
        </div>
    </section>

    <!-- Profil Section -->
    <section class="py-10 pb-20 relative bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center mb-20">
                <div class="order-2 md:order-1 relative" data-aos="fade-right">
                    <div class="absolute inset-0 bg-jessa-maroon/10 transform -rotate-3 rounded-2xl"></div>
                    <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Jessa Kost Building" class="relative rounded-2xl shadow-xl object-cover h-[400px] w-full">
                </div>

                <div class="order-1 md:order-2" data-aos="fade-left">
                    <h3 class="text-2xl font-bold text-jessa-dark mb-4">Kenyamanan Kost Modern</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Berdiri dengan tujuan memberikan hunian sementara terbaik bagi mahasiswa UNSRI Indralaya, Jessa Kost tidak hanya sekadar tempat tidur, melainkan ruang yang mendukung gaya hidup produktif.
                    </p>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Kami memadukan desain interior yang rapi dengan warna <i>cream</i> yang menenangkan dan sentuhan <i>maroon</i> yang elegan. Lokasi kami sangat strategis, hanya 5 menit berjalan kaki ke kampus UNSRI.
                    </p>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="border-l-4 border-jessa-maroon pl-4">
                            <h3 class="text-3xl font-extrabold text-jessa-dark">30+</h3>
                            <p class="text-sm text-gray-500 font-medium">Kamar Eksklusif</p>
                        </div>
                        <div class="border-l-4 border-jessa-maroon pl-4">
                            <h3 class="text-3xl font-extrabold text-jessa-dark">5 Menit</h3>
                            <p class="text-sm text-gray-500 font-medium">Ke Kampus UNSRI</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengelola / Bapak Kost -->
            <div class="bg-jessa-creamDark rounded-3xl p-8 md:p-12 shadow-sm border border-jessa-cream" data-aos="fade-up">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    <div class="md:col-span-1 flex justify-center">
                        <div class="relative w-48 h-48 rounded-full overflow-hidden border-4 border-white shadow-xl">
                            <!-- Placeholder image for Bapak Kost -->
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Bapak Kost" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="md:col-span-2 text-center md:text-left">
                        <h3 class="text-2xl font-bold text-jessa-dark mb-2">Bapak Jessa (Pengelola Kost)</h3>
                        <p class="text-jessa-maroon font-medium mb-4">Siap Membantu 24 Jam</p>
                        <p class="text-gray-700 leading-relaxed mb-6 italic">
                            "Saya mengerti kebutuhan anak-anak mahasiswa yang kadang repot mengurus segala sesuatunya sendiri. Di Jessa Kost, saya pastikan kenyamanan dan keamanan kalian terjaga seperti di rumah sendiri. Kalau ada keran bocor atau lampu mati, langsung lapor saja, pasti segera dibereskan!"
                        </p>
                        <a href="{{ route('kontak') }}" class="inline-block bg-jessa-maroon text-white px-6 py-2 rounded-lg hover:bg-jessa-maroonDark transition-colors">
                            Hubungi Bapak Kost
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
