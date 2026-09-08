@extends('layouts.public', ['title' => 'Kamar - Kost 5 Menit ke UNSRI'])

@section('content')
    <div class="pt-20 bg-gray-50/50 min-h-screen relative overflow-hidden" x-data="{
        modalOpen: false,
        activeImage: '',
        roomData: {
            number: '',
            price: '',
            desc: '',
            cover: '',
            gallery: [],
            status: ''
        }
    }">
        <!-- Animated Background Orbs (Subtle) -->
        <div class="absolute top-20 right-0 w-[300px] md:w-[500px] h-[300px] md:h-[500px] bg-jessa-maroon/5 rounded-full filter blur-[80px] md:blur-[100px] animate-pulse-slow pointer-events-none"></div>
        <div class="absolute bottom-20 left-0 w-[250px] md:w-[400px] h-[250px] md:h-[400px] bg-jessa-cream/30 rounded-full filter blur-[60px] md:blur-[80px] animate-float pointer-events-none" style="animation-delay: 2s;"></div>

        <section class="py-20 relative z-10">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col items-center text-center mb-20" data-aos="fade-down">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <span class="w-12 h-0.5 bg-jessa-maroon"></span>
                        <span class="bg-jessa-maroon/10 text-jessa-maroon font-bold px-4 py-1.5 rounded-full text-sm uppercase tracking-widest">Tipe Kamar Kami</span>
                        <span class="w-12 h-0.5 bg-jessa-maroon"></span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-jessa-dark mb-4 tracking-tight">Ketersediaan <span class="text-jessa-maroon">Real-time</span></h2>
                    <p class="text-gray-600 text-lg font-medium max-w-2xl mx-auto">Lihat dan pilih kamar idamanmu. Dilengkapi dengan galeri foto mendetail. Status ketersediaan diperbarui otomatis langsung dari sistem kami.</p>
                </div>

                @if(isset($rooms) && $rooms->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                        @foreach($rooms as $index => $room)
                        @php
                            $coverImg = $room->cover_image_path ? Storage::url($room->cover_image_path) : 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af';
                            $galleryJson = json_encode($room->detail_image_paths ? array_map(fn($p) => Storage::url($p), $room->detail_image_paths) : []);
                        @endphp
                        <div class="bg-white/90 backdrop-blur-md rounded-[2rem] overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-white transition-all duration-500 hover:shadow-[0_20px_50px_rgba(146,0,58,0.15)] hover:-translate-y-2 group cursor-pointer" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 150 }}"
                            @click="modalOpen = true; roomData = {
                                number: '{{ $room->room_number }}',
                                price: '{{ number_format($room->price_per_month, 0, ',', '.') }}',
                                desc: `{{ $room->description ? $room->description : 'Full Furnished (Kasur, Lemari, Meja)\nKamar Mandi Dalam\nWiFi Berkecepatan Tinggi' }}`,
                                cover: '{{ $coverImg }}',
                                gallery: {{ $galleryJson }},
                                status: '{{ $room->status }}'
                            }; activeImage = roomData.cover;">

                            <div class="relative h-72 overflow-hidden">
                                <!-- Image Hover Zoom Effect -->
                                <img src="{{ $coverImg }}" alt="Kamar {{ $room->room_number }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

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

                                <!-- Overlay CTA -->
                                <div class="absolute inset-0 bg-jessa-maroon/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-sm">
                                    <span class="bg-white text-jessa-maroon font-bold px-6 py-2 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                        <i class="fas fa-images mr-2"></i>Lihat Galeri & Detail
                                    </span>
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
                                </ul>

                                <button class="block w-full py-4 px-4 bg-jessa-cream text-jessa-maroon font-bold text-center rounded-xl shadow-sm hover:bg-jessa-maroon hover:text-white transition-all duration-300">
                                    Lihat Selengkapnya
                                </button>
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

            <!-- Room Detail Modal (AlpineJS) -->
            <template x-teleport="body">
                <div x-show="modalOpen" class="fixed inset-0 z-[9999] overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                        <div x-show="modalOpen"
                             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                             class="fixed inset-0 bg-gray-900/80 backdrop-blur-md transition-opacity"
                             @click="modalOpen = false"></div>

                    <!-- Trick to center -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div x-show="modalOpen"
                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-full sm:translate-y-0 sm:scale-95"
                         class="inline-block align-bottom bg-white rounded-t-[2rem] sm:rounded-[2.5rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle w-full max-w-5xl border border-gray-100">

                        <button @click="modalOpen = false" class="absolute top-4 right-4 sm:top-6 sm:right-6 z-10 w-10 h-10 sm:w-12 sm:h-12 bg-white/80 backdrop-blur-md rounded-full flex items-center justify-center text-gray-800 hover:bg-red-50 hover:text-red-600 transition-colors shadow-lg border border-gray-100">
                            <i class="fas fa-times text-lg sm:text-xl"></i>
                        </button>

                        <div class="grid grid-cols-1 md:grid-cols-2 h-full">
                            <!-- Left: Gallery -->
                            <div class="bg-gray-100 p-6 flex flex-col gap-4">
                                <!-- Main Image -->
                                <div class="rounded-3xl overflow-hidden aspect-[4/3] bg-gray-200 shadow-inner relative group border border-gray-200">
                                    <img :src="activeImage" class="w-full h-full object-cover transition-opacity duration-300">
                                </div>
                                <!-- Thumbnails -->
                                <div class="grid grid-cols-4 gap-3">
                                    <div @click="activeImage = roomData.cover" class="aspect-square rounded-2xl overflow-hidden cursor-pointer border-[3px] transition-all" :class="activeImage === roomData.cover ? 'border-jessa-maroon shadow-md scale-105' : 'border-transparent hover:border-white/50 opacity-70 hover:opacity-100'">
                                        <img :src="roomData.cover" class="w-full h-full object-cover">
                                    </div>
                                    <template x-for="img in roomData.gallery" :key="img">
                                        <div @click="activeImage = img" class="aspect-square rounded-2xl overflow-hidden cursor-pointer border-[3px] transition-all" :class="activeImage === img ? 'border-jessa-maroon shadow-md scale-105' : 'border-transparent hover:border-white/50 opacity-70 hover:opacity-100'">
                                            <img :src="img" class="w-full h-full object-cover">
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Right: Details -->
                            <div class="p-8 md:p-10 flex flex-col justify-between bg-white">
                                <div>
                                    <div class="mb-4">
                                        <template x-if="roomData.status === 'available'">
                                            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-green-50 text-green-600 rounded-full text-sm font-bold border border-green-100">
                                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Tersedia
                                            </div>
                                        </template>
                                        <template x-if="roomData.status !== 'available'">
                                            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-sm font-bold border border-red-100">
                                                <i class="fas fa-lock"></i> Terisi
                                            </div>
                                        </template>
                                    </div>

                                    <h3 class="text-4xl font-black text-gray-900 mb-2" x-text="'Kamar ' + roomData.number"></h3>
                                    <p class="text-jessa-maroon font-bold text-3xl mb-8" x-text="'Rp ' + roomData.price + ' / bln'"></p>

                                    <h4 class="font-extrabold text-gray-900 mb-4 flex items-center gap-2">
                                        <i class="fas fa-info-circle text-jessa-maroon"></i> Deskripsi & Fasilitas
                                    </h4>
                                    <div class="bg-jessa-cream rounded-2xl p-6 border border-jessa-maroon/10 mb-8">
                                        <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line font-medium" x-text="roomData.desc"></p>
                                    </div>

                                    <ul class="space-y-4 mb-8">
                                        <li class="flex items-start text-sm text-gray-700 font-bold">
                                            <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3 shrink-0">
                                                <i class="fas fa-check text-xs"></i>
                                            </div>
                                            Full Furnished (Kasur Premium, Lemari, Meja Kerja)
                                        </li>
                                        <li class="flex items-start text-sm text-gray-700 font-bold">
                                            <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3 shrink-0">
                                                <i class="fas fa-check text-xs"></i>
                                            </div>
                                            Kamar Mandi Dalam Eksklusif
                                        </li>
                                        <li class="flex items-start text-sm text-gray-700 font-bold">
                                            <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3 shrink-0">
                                                <i class="fas fa-check text-xs"></i>
                                            </div>
                                            Akses Kunci Digital Bebas Jam Malam
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <template x-if="roomData.status === 'available'">
                                        <a href="{{ route('kontak') }}" @click="modalOpen = false" class="block w-full py-4 bg-gradient-to-r from-jessa-maroon to-jessa-maroonLight text-white font-extrabold text-center rounded-2xl hover:shadow-[0_8px_25px_rgba(146,0,58,0.4)] hover:-translate-y-1 transition-all duration-300 text-lg">
                                            <i class="fab fa-whatsapp mr-2 text-green-400 text-xl"></i> Hubungi Admin (Booking)
                                        </a>
                                    </template>
                                    <template x-if="roomData.status !== 'available'">
                                        <button disabled class="block w-full py-4 bg-gray-100 text-gray-400 font-bold text-center rounded-2xl border border-gray-200 cursor-not-allowed">
                                            Kamar Sedang Disewa
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </section>
    </div>
@endsection
