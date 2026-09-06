@extends('layouts.public', ['title' => 'Cek Ketersediaan Kamar'])

@section('content')
    <!-- Kamar Section -->
    <section class="py-20 relative min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16" data-aos="fade-up">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center justify-center p-2 bg-white rounded-full shadow-sm mb-4 border border-gray-100">
                        <span class="bg-jessa-maroon/10 text-jessa-maroon font-bold px-4 py-1.5 rounded-full text-sm uppercase tracking-widest">Tipe Kamar Kami</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-jessa-dark mb-4 tracking-tight">Ketersediaan <span class="text-jessa-maroon">Real-time</span></h2>
                    <p class="text-gray-600 text-lg font-medium">Lihat dan pilih kamar idamanmu. Status ketersediaan diperbarui otomatis langsung dari sistem kami.</p>
                </div>
            </div>

            @if(isset($rooms) && $rooms->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($rooms as $index => $room)
                    <div class="bg-white/90 backdrop-blur-md rounded-[2rem] overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-white transition-all duration-500 hover:shadow-[0_20px_50px_rgba(146,0,58,0.15)] hover:-translate-y-2 group" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 150 }}">
                        <div class="relative h-72 overflow-hidden">
                            <!-- Image Hover Zoom Effect -->
                            <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kamar {{ $room->room_number }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

                            <!-- Status Badges with Pulse if available -->
                            @if($room->status == 'available')
                                <div class="absolute top-5 right-5 bg-green-500/90 backdrop-blur-md text-white text-sm font-extrabold px-4 py-2 rounded-full shadow-[0_0_15px_rgba(34,197,94,0.5)] border border-green-400 flex items-center gap-2">
                                    <span class="w-2 h-2 bg-white rounded-full animate-ping"></span> Tersedia
                                </div>
                            @else
                                <div class="absolute top-5 right-5 bg-red-500/90 backdrop-blur-md text-white text-sm font-extrabold px-4 py-2 rounded-full shadow-lg border border-red-400">
                                    <i class="fas fa-lock mr-1 text-xs"></i> Terisi
                                </div>
                            @endif

                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-jessa-dark/90 via-jessa-dark/40 to-transparent p-6 pt-16">
                                <h3 class="text-3xl font-extrabold text-white group-hover:text-jessa-cream transition-colors">Kamar {{ $room->room_number }}</h3>
                            </div>
                        </div>

                        <div class="p-8 relative">
                            <!-- Background decoration inside card -->
                            <div class="absolute top-0 right-0 w-24 h-24 bg-jessa-maroon/5 rounded-bl-[100%] pointer-events-none"></div>

                            <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-100">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1 font-semibold uppercase tracking-wider">Investasi Kenyamanan</p>
                                    <p class="text-3xl font-extrabold text-jessa-maroon">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}<span class="text-sm text-gray-400 font-medium ml-1">/ bulan</span></p>
                                </div>
                            </div>

                            <ul class="space-y-4 mb-8">
                                <li class="flex items-start text-base text-gray-600 font-medium">
                                    <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3 mt-0.5 shrink-0">
                                        <i class="fas fa-check text-xs"></i>
                                    </div>
                                    Full Furnished (Kasur Hotel, Lemari 2 Pintu, Meja Estetik)
                                </li>
                                <li class="flex items-start text-base text-gray-600 font-medium">
                                    <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3 mt-0.5 shrink-0">
                                        <i class="fas fa-check text-xs"></i>
                                    </div>
                                    Kamar Mandi Dalam & Kloset Duduk
                                </li>
                                <li class="flex items-start text-base text-gray-600 font-medium">
                                    <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3 mt-0.5 shrink-0">
                                        <i class="fas fa-check text-xs"></i>
                                    </div>
                                    Smart Digital Lock Access (Bebas Jam Malam)
                                </li>
                            </ul>

                            @if($room->status == 'available')
                                <a href="{{ route('kontak') }}" class="block w-full py-4 px-4 bg-gradient-to-r from-jessa-maroon to-jessa-maroonLight text-white font-bold text-center rounded-xl shadow-[0_4px_15px_rgba(146,0,58,0.3)] hover:shadow-[0_8px_25px_rgba(146,0,58,0.5)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group/btn">
                                    <span class="relative z-10">Amankan Kamar Ini</span>
                                    <!-- Shine effect on button -->
                                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/20 to-transparent group-hover/btn:animate-[shimmer_1.5s_infinite]"></div>
                                </a>
                            @else
                                <button disabled class="block w-full py-4 px-4 bg-gray-100 text-gray-400 font-bold text-center rounded-xl border border-gray-200 cursor-not-allowed">
                                    Kamar Sedang Disewa
                                </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white/80 backdrop-blur-md p-16 rounded-[3rem] text-center shadow-xl border border-white relative overflow-hidden" data-aos="fade-up">
                    <div class="absolute inset-0 bg-jessa-maroon/5 mix-blend-multiply"></div>
                    <div class="relative z-10">
                        <div class="w-24 h-24 bg-jessa-maroon/10 text-jessa-maroon rounded-full flex items-center justify-center mx-auto mb-8 text-4xl shadow-inner">
                            <i class="fas fa-door-closed"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-jessa-dark mb-4">Mohon Maaf, Kamar Penuh</h3>
                        <p class="text-gray-600 text-lg mb-8 max-w-xl mx-auto font-medium">Tingginya antusiasme mahasiswa menyebabkan seluruh kamar Jessa Kost saat ini sudah terisi. Bergabunglah dengan daftar tunggu kami!</p>
                        <a href="{{ route('kontak') }}" class="inline-flex items-center gap-3 py-4 px-10 bg-jessa-maroon text-white font-bold rounded-full hover:bg-jessa-maroonDark transition-all duration-300 shadow-xl hover:-translate-y-1 hover:scale-105">
                            <i class="fab fa-whatsapp text-xl text-green-400"></i> Masuk Daftar Tunggu (Waiting List)
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Tailwind Config for button shimmer -->
    <style>
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
    </style>
@endsection
