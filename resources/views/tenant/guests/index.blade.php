<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-book-open"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Buku Tamu Saya</h2>
                <p class="text-sm text-gray-400 font-medium">Laporkan tamu atau teman yang berkunjung</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6" x-data="{ photoModalOpen: false, currentPhoto: '' }">

        @if(session('success'))
            <div class="p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl font-bold flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end">
            <a href="{{ route('tenant.guests.create') }}" class="bg-jessa-maroon text-white px-5 py-2.5 rounded-xl font-bold shadow-sm hover:bg-jessa-maroonDark transition-colors flex items-center gap-2">
                <i class="fas fa-plus"></i> Lapor Tamu Baru
            </a>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-gray-900 text-lg">Riwayat Tamu</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-50">
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Nama Tamu</th>
                            <th class="p-4">Tujuan</th>
                            <th class="p-4">Status Menginap</th>
                            <th class="p-4 text-center">KTP / ID</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium">
                        @forelse($guests as $guest)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($guest->visit_date)->translatedFormat('d M Y') }}</td>
                            <td class="p-4">
                                <p class="font-bold text-gray-900">{{ $guest->visitor_name }}</p>
                            </td>
                            <td class="p-4 text-gray-500">{{ Str::limit($guest->purpose, 30) }}</td>
                            <td class="p-4">
                                @if($guest->is_overnight)
                                    <span class="inline-flex items-center gap-1 bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold border border-yellow-100">
                                        <i class="fas fa-moon"></i> Menginap
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-bold border border-blue-100">
                                        <i class="fas fa-sun"></i> Kunjungan Singkat
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @if($guest->id_card_photo_path)
                                    <button @click="currentPhoto = '{{ asset('storage/' . $guest->id_card_photo_path) }}'; photoModalOpen = true" class="text-jessa-maroon hover:underline font-bold text-xs bg-red-50 px-3 py-1.5 rounded-lg border border-red-100 transition-colors">
                                        <i class="fas fa-image"></i> Lihat Foto
                                    </button>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-400 font-medium">
                                Belum ada riwayat tamu.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Premium Image Viewer Modal --}}
        <div x-show="photoModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/95 backdrop-blur-md p-4 sm:p-8 transition-all" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <!-- Floating Close Button -->
            <button @click="photoModalOpen = false" class="absolute top-6 right-6 sm:top-10 sm:right-10 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-full w-12 h-12 flex items-center justify-center transition-all shadow-lg border border-white/10 hover:scale-105 z-50">
                <i class="fas fa-times text-xl"></i>
            </button>

            <!-- Image Container -->
            <div class="relative w-full max-w-5xl flex flex-col items-center justify-center h-full" @click.away="photoModalOpen = false" x-transition:enter="transition ease-out duration-300 delay-100" x-transition:enter-start="opacity-0 scale-95 translate-y-8" x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                <div class="relative group">
                    <img :src="currentPhoto" alt="ID Card" class="max-h-[75vh] w-auto object-contain rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/10 transition-transform duration-300 group-hover:scale-[1.02]">

                    <!-- Gradient Overlay on Hover for premium feel -->
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                </div>

                <p class="mt-8 text-white/90 font-bold text-sm text-center px-6 py-3 bg-white/10 backdrop-blur-xl rounded-full shadow-lg border border-white/10 tracking-wide">
                    <i class="fas fa-id-card text-jessa-cream mr-2"></i> KARTU IDENTITAS TAMU
                </p>
            </div>
        </div>

    </div>
</x-app-layout>
