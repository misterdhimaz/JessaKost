<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon border border-jessa-maroon/20">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                        {{ __('Buku Tamu & Keamanan') }}
                    </h2>
                    <p class="text-sm text-gray-500 font-medium mt-1">Pantau kunjungan dan identitas tamu kost.</p>
                </div>
            </div>
            <button @click="createModalOpen = true" class="inline-flex items-center justify-center gap-2 bg-jessa-maroon text-white font-bold px-6 py-3 rounded-xl hover:bg-jessa-maroonDark transition-all shadow-sm hover:shadow-md">
                <i class="fas fa-user-plus"></i> Catat Tamu Baru
            </button>
        </div>
    </x-slot>

    <div class="space-y-6" x-data="{ photoModalOpen: false, currentPhoto: '', createModalOpen: false }">
        
        {{-- Filter Section --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            <form method="GET" action="{{ route('admin.guests.index') }}" class="flex flex-col md:flex-row gap-4">
                
                {{-- Search --}}
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau keperluan tamu..." class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:ring-jessa-maroon focus:border-jessa-maroon transition-colors">
                    </div>
                </div>

                {{-- Filter Tipe --}}
                <div class="w-full md:w-48">
                    <select name="type" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 focus:ring-jessa-maroon focus:border-jessa-maroon transition-colors">
                        <option value="">Semua Kunjungan</option>
                        <option value="visit" {{ request('type') == 'visit' ? 'selected' : '' }}>Kunjungan Singkat</option>
                        <option value="overnight" {{ request('type') == 'overnight' ? 'selected' : '' }}>Menginap</option>
                    </select>
                </div>

                {{-- Filter Kamar --}}
                <div class="w-full md:w-48">
                    <select name="room_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 focus:ring-jessa-maroon focus:border-jessa-maroon transition-colors">
                        <option value="">Semua Kamar</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>Kamar {{ $room->room_number }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-gray-900 hover:bg-black text-white px-6 py-3 rounded-xl font-bold text-sm transition-colors shadow-sm">
                        Filter
                    </button>
                    @if(request()->anyFilled(['search', 'type', 'room_id']))
                        <a href="{{ route('admin.guests.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-3 rounded-xl font-bold text-sm transition-colors flex items-center justify-center" title="Reset Filter">
                            <i class="fas fa-undo"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Guest Cards Grid --}}
        @if($guests->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($guests as $guest)
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 flex flex-col relative overflow-hidden group hover:shadow-md transition-shadow">
                    
                    {{-- Decorative Top Right --}}
                    @if($guest->is_overnight)
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-yellow-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                    @else
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                    @endif

                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="flex gap-3">
                            <div class="w-12 h-12 rounded-xl {{ $guest->is_overnight ? 'bg-yellow-100 text-yellow-600 border-yellow-200' : 'bg-blue-100 text-blue-600 border-blue-200' }} border flex items-center justify-center text-xl shrink-0">
                                <i class="fas {{ $guest->is_overnight ? 'fa-moon' : 'fa-sun' }}"></i>
                            </div>
                            <div>
                                <h4 class="font-extrabold text-gray-900 text-lg leading-tight">{{ $guest->visitor_name }}</h4>
                                <p class="text-xs text-gray-500 font-medium mt-1"><i class="fas fa-calendar-day mr-1"></i> {{ \Carbon\Carbon::parse($guest->visit_date)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6 flex-1 relative z-10">
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Keperluan Kunjungan</p>
                            <p class="text-sm text-gray-700 font-medium">{{ $guest->purpose }}</p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-jessa-cream/50 text-jessa-maroon flex items-center justify-center text-xs border border-jessa-maroon/20">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Dikunjungi / Pelapor</p>
                                <p class="text-xs font-bold text-gray-900">
                                    {{ $guest->tenant->name ?? 'Penghuni Tidak Diketahui' }} 
                                    @php
                                        $activeLease = $guest->tenant?->leases?->where('status', 'active')->first();
                                    @endphp
                                    @if($activeLease)
                                        <span class="text-jessa-maroon">(Kamar {{ $activeLease->room->room_number }})</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between relative z-10 mt-auto">
                        @if($guest->is_overnight)
                            <span class="px-3 py-1 bg-yellow-50 text-yellow-700 text-xs font-bold rounded-lg border border-yellow-100 uppercase tracking-wide">
                                Menginap
                            </span>
                        @else
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg border border-blue-100 uppercase tracking-wide">
                                Singkat
                            </span>
                        @endif

                        @if($guest->id_card_photo_path)
                            <button @click="currentPhoto = '{{ asset('storage/' . $guest->id_card_photo_path) }}'; photoModalOpen = true" class="text-jessa-maroon hover:text-white bg-jessa-maroon/5 hover:bg-jessa-maroon px-4 py-2 rounded-xl text-xs font-bold transition-colors border border-jessa-maroon/20 hover:border-jessa-maroon shadow-sm flex items-center gap-2">
                                <i class="fas fa-id-card"></i> Lihat KTP
                            </button>
                        @else
                            <span class="text-xs text-gray-400 font-medium italic"><i class="fas fa-times-circle mr-1"></i>Tanpa KTP</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 text-center flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-4 text-4xl border border-gray-100">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3 class="font-extrabold text-gray-900 text-xl mb-1">Tidak ada catatan tamu</h3>
                <p class="text-gray-500 font-medium">Belum ada tamu yang tercatat atau cocok dengan filter Anda.</p>
            </div>
        @endif

        {{-- Premium Image Viewer Modal --}}
        <div x-show="photoModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/95 backdrop-blur-md p-4 sm:p-8 transition-all" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <button @click="photoModalOpen = false" class="absolute top-6 right-6 sm:top-10 sm:right-10 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-full w-12 h-12 flex items-center justify-center transition-all shadow-lg border border-white/10 hover:scale-105 z-50">
                <i class="fas fa-times text-xl"></i>
            </button>
            <div class="relative w-full max-w-5xl flex flex-col items-center justify-center h-full" @click.away="photoModalOpen = false" x-transition:enter="transition ease-out duration-300 delay-100" x-transition:enter-start="opacity-0 scale-95 translate-y-8" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                <div class="relative group">
                    <img :src="currentPhoto" alt="ID Card" class="max-h-[75vh] w-auto object-contain rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/10 transition-transform duration-300 group-hover:scale-[1.02]">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                </div>
                <p class="mt-8 text-white/90 font-bold text-sm text-center px-6 py-3 bg-white/10 backdrop-blur-xl rounded-full shadow-lg border border-white/10 tracking-wide">
                    <i class="fas fa-id-card text-jessa-cream mr-2"></i> KARTU IDENTITAS TAMU
                </p>
            </div>
        </div>

        {{-- Modal Create Guest --}}
        <div x-show="createModalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="bg-white rounded-[2rem] w-full max-w-2xl shadow-2xl overflow-hidden" @click.away="createModalOpen = false" x-transition:enter="transition ease-out duration-300 delay-100" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-xl font-extrabold text-gray-900"><i class="fas fa-user-plus text-jessa-maroon mr-2"></i> Catat Tamu Baru</h3>
                    <button @click="createModalOpen = false" class="text-gray-400 hover:text-red-500 transition-colors w-8 h-8 flex items-center justify-center rounded-full hover:bg-red-50">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                <form action="{{ route('admin.guests.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Penghuni yang Dikunjungi <span class="text-red-500">*</span></label>
                            <select name="tenant_id" required class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon">
                                <option value="">-- Pilih Penghuni Aktif --</option>
                                @foreach($tenants ?? [] as $tenant)
                                    <option value="{{ $tenant->id }}">{{ $tenant->name }} (Kamar {{ $tenant->leases->first()->room->room_number ?? '?' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Tamu <span class="text-red-500">*</span></label>
                            <input type="text" name="visitor_name" required class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon" placeholder="Contoh: Budi Santoso">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Kunjungan <span class="text-red-500">*</span></label>
                            <input type="date" name="visit_date" required value="{{ date('Y-m-d') }}" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon">
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Keperluan <span class="text-red-500">*</span></label>
                            <input type="text" name="purpose" required class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon" placeholder="Contoh: Berkunjung keluarga / Belajar kelompok">
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kunjungan</label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_overnight" value="0" checked class="text-jessa-maroon focus:ring-jessa-maroon"> Singkat (Tidak Menginap)
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_overnight" value="1" class="text-yellow-500 focus:ring-yellow-500"> Menginap
                                </label>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Foto KTP Tamu (Opsional)</label>
                            <input type="file" name="id_card_photo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-jessa-maroon/5 file:text-jessa-maroon hover:file:bg-jessa-maroon/10">
                        </div>
                    </div>
                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <button type="button" @click="createModalOpen = false" class="px-6 py-2.5 rounded-xl font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">Batal</button>
                        <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-white bg-jessa-maroon hover:bg-jessa-maroonDark transition-colors shadow-sm">Simpan Tamu</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>

