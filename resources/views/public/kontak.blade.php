@extends('layouts.public', ['title' => 'Hubungi Kami'])

@section('content')
    <!-- Page Hero -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 bg-jessa-cream overflow-hidden rounded-b-[2rem] sm:rounded-b-[3rem] border-b border-jessa-maroon/10 mb-10">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1590069261209-f8e9b8642343?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center opacity-10 pointer-events-none"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-jessa-cream via-jessa-cream/80 to-transparent pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-jessa-maroon/10 text-jessa-maroon font-bold text-xs uppercase tracking-widest mb-4 border border-jessa-maroon/20" data-aos="fade-up">Hubungi Kami</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight" data-aos="fade-up" data-aos-delay="100">Kontak <span class="text-jessa-maroon">Jessa Kost</span></h1>
            <p class="text-gray-700 text-lg md:text-xl font-medium max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">Tim kami selalu siap membantu Anda untuk reservasi, tanya jawab, maupun jadwal survei lokasi.</p>
        </div>
    </section>

    <!-- Kontak Section -->
    <section class="py-10 pb-24 relative min-h-[70vh] bg-jessa-creamDark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-jessa-dark rounded-3xl overflow-hidden shadow-2xl relative" data-aos="zoom-in">
                <!-- Abstract Design in CTA -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-jessa-maroon rounded-full mix-blend-screen filter blur-3xl opacity-20"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-yellow-600 rounded-full mix-blend-screen filter blur-3xl opacity-20"></div>

                <div class="grid grid-cols-1 lg:grid-cols-2 relative z-10">
                    <div class="p-12 lg:p-16 flex flex-col justify-center">
                        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6">Tertarik Menjadi Bagian dari Jessa Kost?</h2>
                        <p class="text-gray-300 mb-10 text-lg">
                            Jangan ragu untuk bertanya atau mengatur jadwal survei lokasi. Tim admin kami siap melayani Anda dengan ramah.
                        </p>

                        <div class="space-y-6 mb-10">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-jessa-maroonLight mr-4">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-400">WhatsApp Admin</p>
                                    <p class="text-lg font-semibold text-white">+62 858-3284-1485</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-jessa-maroonLight mr-4">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-400">Alamat Lengkap</p>
                                    <p class="text-lg font-semibold text-white">Jl. Mawar Merah No. 45, Jakarta Selatan</p>
                                </div>
                            </div>
                        </div>

                        <a href="https://wa.me/6285832841485" target="_blank" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded-full transition-colors text-center shadow-lg">
                            <i class="fab fa-whatsapp mr-2"></i> Chat WhatsApp Sekarang
                        </a>
                    </div>

                    <div class="h-96 lg:h-auto w-full relative">
                        <!-- Actual Street View Thumbnail -->
                        <img src="https://streetviewpixels-pa.googleapis.com/v1/thumbnail?cb_client=maps_sv.tactile&w=900&h=600&pitch=8.068447809181833&panoid=b58qy8PqhieZsumwKmN2SA&yaw=178.42180272807605" alt="Map Location Jessa Kost" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-jessa-maroon/20 mix-blend-multiply"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <a href="https://www.google.com/maps/@-3.2081346,104.6500056,12a,75y,178.42h,81.93t/data=!3m7!1e1!3m5!1sb58qy8PqhieZsumwKmN2SA!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fcb_client%3Dmaps_sv.tactile%26w%3D900%26h%3D600%26pitch%3D8.068447809181833%26panoid%3Db58qy8PqhieZsumwKmN2SA%26yaw%3D178.42180272807605!7i16384!8i8192?entry=ttu&g_ep=EgoyMDI2MDkwNi4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="bg-white text-jessa-dark font-bold py-3 px-6 rounded-full shadow-xl hover:scale-105 transition-transform flex items-center text-center">
                                <i class="fas fa-map-marked-alt text-jessa-maroon mr-2"></i> Buka di Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

