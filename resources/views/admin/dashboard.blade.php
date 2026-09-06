<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Dasbor Admin</h2>
                <p class="text-sm text-gray-400 font-medium">Ringkasan operasional hari ini</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">

        {{-- Welcome Banner --}}
        <div class="bg-jessa-maroon rounded-3xl p-8 text-white relative overflow-hidden border-t-4 border-jessa-cream">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 24px 24px;"></div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-center md:text-left">
                    <h3 class="text-3xl font-extrabold mb-2">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-jessa-cream/90 text-lg font-medium">Berikut ringkasan operasional kost hari ini.</p>
                </div>
                <div class="bg-black/20 backdrop-blur-md rounded-2xl px-6 py-4 border border-white/10 text-center">
                    <p class="text-white/70 text-xs font-bold uppercase tracking-wider mb-1">Tanggal</p>
                    <p class="text-xl font-bold">{{ now()->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 text-center group hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-xl text-jessa-maroon mb-3 mx-auto group-hover:scale-110 transition-transform">
                    <i class="fas fa-door-open"></i>
                </div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-wider mb-1">Kamar Kosong</p>
                <p class="text-3xl font-extrabold text-gray-900">{{ $emptyRooms }}</p>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 text-center group hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-xl text-green-500 mb-3 mx-auto group-hover:scale-110 transition-transform">
                    <i class="fas fa-user-check"></i>
                </div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-wider mb-1">Kamar Terisi</p>
                <p class="text-3xl font-extrabold text-gray-900">{{ $occupiedRooms }} <span class="text-base text-gray-300 font-medium">/ {{ $totalRooms }}</span></p>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 text-center group hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-xl text-red-500 mb-3 mx-auto group-hover:scale-110 transition-transform">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-wider mb-1">Keluhan Aktif</p>
                <p class="text-3xl font-extrabold text-gray-900">{{ $activeTickets }}</p>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 text-center group hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-xl text-blue-500 mb-3 mx-auto group-hover:scale-110 transition-transform">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-wider mb-1">Tamu Hari Ini</p>
                <p class="text-3xl font-extrabold text-gray-900">{{ $todayGuests }}</p>
            </div>
        </div>

        {{-- Rooms Table + Quick Actions --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-extrabold text-gray-900"><i class="fas fa-bed text-jessa-maroon mr-2"></i>Status Kamar</h3>
                    <a href="{{ route('admin.rooms.index') }}" class="text-sm font-bold text-jessa-maroon hover:underline">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-50">
                                <th class="p-4">Kamar</th>
                                <th class="p-4">Harga</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium">
                            @foreach($rooms->take(5) as $room)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="p-4">
                                    <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-600 font-bold">{{ $room->room_number }}</div>
                                </td>
                                <td class="p-4 text-gray-600">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    @if($room->status == 'occupied')
                                        <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Terisi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Kosong
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    @if($room->status == 'occupied')
                                        <a href="{{ route('admin.electricity.input') }}" class="text-blue-600 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors inline-flex items-center gap-1.5">
                                            <i class="fas fa-bolt"></i> Listrik
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                <h3 class="font-extrabold text-gray-900"><i class="fas fa-bolt text-jessa-maroon mr-2"></i>Akses Cepat</h3>

                <a href="{{ route('admin.guests.index') }}" class="flex items-center gap-4 p-4 rounded-2xl border border-gray-100 hover:border-jessa-maroon/30 hover:bg-jessa-cream/30 transition-all group">
                    <div class="w-11 h-11 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon group-hover:bg-jessa-maroon group-hover:text-white transition-colors shrink-0">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm">Buku Tamu</h4>
                        <p class="text-xs text-gray-400 font-medium">Catat pengunjung baru</p>
                    </div>
                    <i class="fas fa-chevron-right ml-auto text-gray-300 text-xs"></i>
                </a>

                <a href="{{ route('admin.tickets.index') }}" class="flex items-center gap-4 p-4 rounded-2xl border border-gray-100 hover:border-red-500/30 hover:bg-red-50 transition-all group">
                    <div class="w-11 h-11 bg-red-50 rounded-xl flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-colors shrink-0">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm">Tinjau Keluhan</h4>
                        <p class="text-xs text-gray-400 font-medium">Tindak lanjuti laporan</p>
                    </div>
                    <i class="fas fa-chevron-right ml-auto text-gray-300 text-xs"></i>
                </a>

                <a href="{{ route('admin.electricity.input') }}" class="flex items-center gap-4 p-4 rounded-2xl border border-gray-100 hover:border-blue-500/30 hover:bg-blue-50 transition-all group">
                    <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors shrink-0">
                        <i class="fas fa-plug"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm">Meteran Listrik</h4>
                        <p class="text-xs text-gray-400 font-medium">Input kWh bulanan</p>
                    </div>
                    <i class="fas fa-chevron-right ml-auto text-gray-300 text-xs"></i>
                </a>
                <a href="{{ route('admin.announcements.index') }}" class="flex items-center gap-4 p-4 rounded-2xl border border-gray-100 hover:border-yellow-500/30 hover:bg-yellow-50 transition-all group">
                    <div class="w-11 h-11 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-500 group-hover:bg-yellow-500 group-hover:text-white transition-colors shrink-0">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm">Pengumuman</h4>
                        <p class="text-xs text-gray-400 font-medium">Kelola info & broadcast</p>
                    </div>
                    <i class="fas fa-chevron-right ml-auto text-gray-300 text-xs"></i>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
