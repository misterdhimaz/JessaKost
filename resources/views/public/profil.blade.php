@extends('layouts.public', ['title' => 'Profil Kami'])

@section('content')
    <!-- Profil Section -->
    <section class="py-20 relative bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h4 class="text-jessa-maroon font-bold tracking-wider uppercase text-sm mb-2">Tentang Kami</h4>
                <h2 class="text-3xl md:text-4xl font-extrabold text-jessa-dark mb-4">Profil Jessa Kost</h2>
                <div class="w-24 h-1 bg-jessa-maroon mx-auto"></div>
            </div>

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
