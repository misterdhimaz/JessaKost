<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tenant.dashboard') }}" class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900">Manajemen Laporan</h2>
                <p class="text-sm text-gray-500 font-medium">Kirim dan pantau status laporan fasilitas atau keluhan Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6" x-data="{ showModal: {{ $errors->any() ? 'true' : 'false' }} }">

            {{-- CTA Buat Laporan Baru --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 p-6 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500 text-2xl shrink-0">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div>
                        <p class="font-extrabold text-gray-900 text-lg">Ada yang perlu diperbaiki?</p>
                        <p class="text-sm text-gray-500 font-medium">Laporkan fasilitas rusak, kendala layanan, atau keluhan lainnya.</p>
                    </div>
                </div>
                <button @click="showModal = true" class="shrink-0 bg-jessa-maroon text-white font-bold px-6 py-3 rounded-xl hover:bg-jessa-maroonDark transition-colors shadow-sm flex items-center gap-2">
                    <i class="fas fa-plus"></i> Buat Laporan Baru
                </button>
            </div>

            {{-- Ticket List --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="font-extrabold text-gray-900 text-lg">Riwayat Laporan Saya</h3>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse($tickets as $ticket)
                    <div class="p-6 flex flex-col md:flex-row md:items-start justify-between gap-6 hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0 mt-0.5
                                {{ $ticket->status == 'resolved' ? 'bg-green-50 text-green-500' :
                                   ($ticket->status == 'in_progress' ? 'bg-yellow-50 text-yellow-500' : 'bg-red-50 text-red-500') }}">
                                <i class="fas {{ $ticket->status == 'resolved' ? 'fa-check-circle' : ($ticket->status == 'in_progress' ? 'fa-spinner' : 'fa-exclamation-circle') }}"></i>
                            </div>
                            <div>
                                <p class="font-extrabold text-gray-900 text-lg">{{ $ticket->title }}</p>
                                <div class="flex items-center gap-2 mt-1 mb-2">
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider
                                        {{ $ticket->category == 'kerusakan' ? 'bg-orange-100 text-orange-700' :
                                           ($ticket->category == 'keluhan' ? 'bg-purple-100 text-purple-700' :
                                           ($ticket->category == 'layanan' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700')) }}">
                                        {{ ucfirst($ticket->category ?? 'Lainnya') }}
                                    </span>
                                    <span class="text-xs text-gray-400 font-medium">
                                        <i class="fas fa-calendar mr-1"></i> {{ $ticket->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 font-medium leading-relaxed max-w-2xl bg-gray-50 p-3 rounded-xl border border-gray-100">{{ $ticket->description }}</p>

                                @if($ticket->image_path)
                                <a href="{{ asset('storage/' . $ticket->image_path) }}" target="_blank" class="inline-flex items-center gap-2 mt-3 text-xs font-bold text-jessa-maroon bg-jessa-maroon/5 hover:bg-jessa-maroon/10 px-3 py-1.5 rounded-lg transition-colors border border-jessa-maroon/10">
                                    <i class="fas fa-image"></i> Lihat Bukti Foto
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="md:flex-shrink-0 flex flex-col items-end">
                            @if($ticket->status == 'pending')
                                <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 border border-red-100 px-3 py-1.5 rounded-full text-xs font-bold">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span> Menunggu Tindakan
                                </span>
                            @elseif($ticket->status == 'in_progress')
                                <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 border border-yellow-100 px-3 py-1.5 rounded-full text-xs font-bold">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span> Sedang Diproses
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 border border-green-100 px-3 py-1.5 rounded-full text-xs font-bold">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Sudah Selesai
                                </span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="p-16 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-200 mx-auto mb-4 text-3xl">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <p class="font-bold text-gray-900 text-lg mb-1">Belum Ada Laporan</p>
                        <p class="text-gray-400 font-medium text-sm">Anda belum pernah mengirimkan laporan. Semoga semua fasilitas berjalan baik!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Modal Form Buat Laporan -->
            <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" @click="showModal = false" aria-hidden="true"></div>

                    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative inline-block w-full max-w-xl p-8 overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl rounded-[2rem] sm:my-8 sm:align-middle">

                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-xl font-extrabold text-gray-900">Buat Laporan Baru</h3>
                                <p class="text-sm text-gray-500">Isi detail keluhan atau kerusakan di bawah ini.</p>
                            </div>
                            <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-500 transition-colors w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form method="POST" action="{{ route('tenant.tickets.store') }}" enctype="multipart/form-data" class="space-y-5">
                            @csrf

                            <div>
                                <x-input-label for="category" value="Kategori Laporan" />
                                <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-jessa-maroon focus:ring-jessa-maroon rounded-xl shadow-sm" required>
                                    <option value="" disabled selected>Pilih Kategori...</option>
                                    <option value="kerusakan" {{ old('category') == 'kerusakan' ? 'selected' : '' }}>Kerusakan Fasilitas</option>
                                    <option value="keluhan" {{ old('category') == 'keluhan' ? 'selected' : '' }}>Keluhan (Suara bising, dll)</option>
                                    <option value="layanan" {{ old('category') == 'layanan' ? 'selected' : '' }}>Kendala Layanan (Air, Listrik, WiFi)</option>
                                    <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="title" value="Judul Laporan" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required placeholder="Contoh: AC Kamar Tidak Dingin" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="description" value="Deskripsi Detail" />
                                <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 focus:border-jessa-maroon focus:ring-jessa-maroon rounded-xl shadow-sm" required placeholder="Jelaskan secara detail masalah yang Anda alami..."></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="image" value="Foto Bukti (Opsional)" />
                                <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-jessa-maroon/10 file:text-jessa-maroon hover:file:bg-jessa-maroon/20 transition-all cursor-pointer border border-gray-200 rounded-xl p-2">
                                <p class="text-xs text-gray-400 mt-2"><i class="fas fa-info-circle mr-1"></i>Maksimal 2MB, format JPG/PNG</p>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                                <button type="button" @click="showModal = false" class="px-5 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl font-bold transition-colors">Batal</button>
                                <button type="submit" class="px-5 py-2.5 text-white bg-jessa-maroon hover:bg-jessa-maroonDark rounded-xl font-bold shadow-sm transition-colors flex items-center gap-2">
                                    <i class="fas fa-paper-plane"></i> Kirim Laporan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </div>
</x-app-layout>
