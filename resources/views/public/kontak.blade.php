@extends('layouts.public', ['title' => 'Hubungi Kami'])

@section('content')
    <!-- Kontak Section -->
    <section class="py-24 relative min-h-screen bg-jessa-creamDark">
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
                                    <p class="text-lg font-semibold text-white">+62 812-3456-7890</p>
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

                        <a href="https://wa.me/6281234567890" target="_blank" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded-full transition-colors text-center shadow-lg">
                            <i class="fab fa-whatsapp mr-2"></i> Chat WhatsApp Sekarang
                        </a>
                    </div>

                    <div class="h-96 lg:h-auto w-full relative">
                        <!-- Simulated Map Image -->
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Map Location" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-jessa-maroon/20 mix-blend-multiply"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <a href="#" class="bg-white text-jessa-dark font-bold py-3 px-6 rounded-full shadow-xl hover:scale-105 transition-transform flex items-center">
                                <i class="fas fa-map-marked-alt text-jessa-maroon mr-2"></i> Buka di Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

