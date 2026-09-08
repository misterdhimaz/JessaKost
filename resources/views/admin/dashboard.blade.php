<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon border border-jessa-maroon/20">
                    <i class="fas fa-chart-pie text-xl"></i>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">Dasbor Admin (Pusat Komando)</h2>
                    <p class="text-sm text-gray-500 font-medium mt-1">Sistem Manajemen & Operasional Cerdas Jessa Kost</p>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-3 bg-white border border-gray-100 shadow-sm rounded-xl px-4 py-2">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Periode Saat Ini</p>
                    <p class="text-sm font-bold text-gray-900">{{ now()->translatedFormat('F Y') }}</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">

        {{-- Top KPI Row --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Pendapatan Masuk --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center justify-between relative z-10 mb-4">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl border border-green-200">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 bg-green-50 text-green-600 rounded-lg border border-green-100">Bulan Ini</span>
                </div>
                <p class="text-gray-500 font-bold text-xs uppercase tracking-wider mb-1 relative z-10">Total Pendapatan</p>
                <h3 class="text-2xl font-extrabold text-gray-900 relative z-10">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>

            {{-- Tagihan Tertunda --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-red-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center justify-between relative z-10 mb-4">
                    <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center text-xl border border-red-200">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 bg-red-50 text-red-600 rounded-lg border border-red-100">{{ $unpaidBillsCount }} Tagihan</span>
                </div>
                <p class="text-gray-500 font-bold text-xs uppercase tracking-wider mb-1 relative z-10">Tagihan Tertunda (Belum Dibayar)</p>
                <h3 class="text-2xl font-extrabold text-gray-900 relative z-10">Rp {{ number_format($pendingRevenue, 0, ',', '.') }}</h3>
            </div>

            {{-- Okupansi Kamar --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-jessa-maroon/5 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center justify-between relative z-10 mb-4">
                    <div class="w-12 h-12 bg-jessa-maroon/10 text-jessa-maroon rounded-xl flex items-center justify-center text-xl border border-jessa-maroon/20">
                        <i class="fas fa-bed"></i>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 bg-gray-50 text-gray-600 rounded-lg border border-gray-200">{{ $emptyRooms }} Kosong</span>
                </div>
                <p class="text-gray-500 font-bold text-xs uppercase tracking-wider mb-1 relative z-10">Tingkat Hunian (Okupansi)</p>
                <div class="flex items-end gap-3 relative z-10">
                    <h3 class="text-3xl font-extrabold text-gray-900 leading-none">{{ $occupancyRate }}%</h3>
                    <p class="text-sm font-medium text-gray-400 mb-1">{{ $occupiedRooms }} dari {{ $totalRooms }} kamar</p>
                </div>
                <div class="w-full bg-gray-100 h-1.5 rounded-full mt-4 relative z-10 overflow-hidden">
                    <div class="bg-jessa-maroon h-1.5 rounded-full" style="width: {{ $occupancyRate }}%"></div>
                </div>
            </div>

            {{-- Keluhan Aktif --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-yellow-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center justify-between relative z-10 mb-4">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center text-xl border border-yellow-200">
                        <i class="fas fa-headset"></i>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 bg-yellow-50 text-yellow-700 rounded-lg border border-yellow-100">Perlu Tindakan</span>
                </div>
                <p class="text-gray-500 font-bold text-xs uppercase tracking-wider mb-1 relative z-10">Keluhan / Laporan Aktif</p>
                <h3 class="text-3xl font-extrabold text-gray-900 leading-none relative z-10">{{ $activeTickets }}</h3>
            </div>
        </div>

        {{-- Central Dashboard Area (2 Columns Layout) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT COLUMN: Financial & Payments (Wider) --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Pembayaran Terbaru --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50">
                        <div>
                            <h3 class="font-extrabold text-lg text-gray-900 flex items-center gap-2">
                                <i class="fas fa-exchange-alt text-green-500"></i> Transaksi Terakhir
                            </h3>
                            <p class="text-xs font-medium text-gray-500 mt-1">Riwayat pembayaran tagihan terbaru oleh tenant.</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                                    <th class="p-4">Tanggal Pembayaran</th>
                                    <th class="p-4">Kamar & Tenant</th>
                                    <th class="p-4">Jenis Tagihan</th>
                                    <th class="p-4 text-right">Nominal</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-medium">
                                @forelse($recentPayments as $payment)
                                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                    <td class="p-4 text-gray-500">{{ \Carbon\Carbon::parse($payment->paid_at)->translatedFormat('d M Y, H:i') }}</td>
                                    <td class="p-4">
                                        <p class="font-bold text-gray-900">Kamar {{ $payment->lease->room->room_number }}</p>
                                        <p class="text-xs text-gray-400">{{ $payment->lease->user->name }}</p>
                                    </td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold border border-{{ $payment->type_color }}/30 text-{{ $payment->type_color }} bg-{{ $payment->type_color }}/5">
                                            <i class="{{ $payment->type_icon }}"></i> {{ $payment->type_label }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-right font-bold text-gray-900">
                                        Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-gray-500 font-medium">Belum ada transaksi pembayaran bulan ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Status Kamar --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <div>
                            <h3 class="font-extrabold text-lg text-gray-900 flex items-center gap-2">
                                <i class="fas fa-door-open text-jessa-maroon"></i> Status Unit Kamar
                            </h3>
                        </div>
                        <a href="{{ route('admin.rooms.index') }}" class="text-sm font-bold text-jessa-maroon hover:underline">Kelola Kamar</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-50">
                                    <th class="p-4">Kamar</th>
                                    <th class="p-4">Harga Sewa</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-medium">
                                @foreach($rooms->take(5) as $room)
                                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-600 font-extrabold border border-gray-200">
                                                {{ $room->room_number }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-600 font-bold">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}</td>
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
                                            <a href="{{ route('admin.electricity.index') }}" class="text-blue-600 bg-blue-50 hover:bg-blue-100 border border-blue-100 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors inline-flex items-center gap-1.5">
                                                <i class="fas fa-bolt"></i> Catat Listrik
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: Tickets, Guests, Quick Access --}}
            <div class="space-y-8">

                {{-- Quick Actions --}}
                <div class="bg-gradient-to-br from-jessa-maroon to-jessa-maroonDark rounded-3xl shadow-lg border border-jessa-maroon/20 p-1 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
                    <div class="bg-white/95 backdrop-blur-xl rounded-[22px] p-5 relative z-10 h-full">
                        <h3 class="font-extrabold text-gray-900 mb-4 text-sm uppercase tracking-widest"><i class="fas fa-rocket text-jessa-maroon mr-2"></i>Aksi Cepat</h3>

                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('admin.electricity.index') }}" class="flex flex-col items-center justify-center gap-2 p-3 rounded-2xl bg-blue-50 border border-blue-100 text-blue-600 hover:bg-blue-500 hover:text-white transition-all text-center group">
                                <i class="fas fa-bolt text-2xl group-hover:scale-110 transition-transform"></i>
                                <span class="text-xs font-bold">Listrik</span>
                            </a>
                            <a href="{{ route('admin.announcements.create') }}" class="flex flex-col items-center justify-center gap-2 p-3 rounded-2xl bg-yellow-50 border border-yellow-100 text-yellow-600 hover:bg-yellow-500 hover:text-white transition-all text-center group">
                                <i class="fas fa-bullhorn text-2xl group-hover:scale-110 transition-transform"></i>
                                <span class="text-xs font-bold">Pengumuman</span>
                            </a>
                            <a href="{{ route('admin.guests.index') }}" class="flex flex-col items-center justify-center gap-2 p-3 rounded-2xl bg-orange-50 border border-orange-100 text-orange-600 hover:bg-orange-500 hover:text-white transition-all text-center group">
                                <i class="fas fa-book-open text-2xl group-hover:scale-110 transition-transform"></i>
                                <span class="text-xs font-bold">Buku Tamu</span>
                            </a>
                            <a href="{{ route('admin.tickets.index') }}" class="flex flex-col items-center justify-center gap-2 p-3 rounded-2xl bg-red-50 border border-red-100 text-red-600 hover:bg-red-500 hover:text-white transition-all text-center group">
                                <i class="fas fa-headset text-2xl group-hover:scale-110 transition-transform"></i>
                                <span class="text-xs font-bold">Laporan</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Recent Complaints / Tickets --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-extrabold text-sm text-gray-900 uppercase tracking-wider"><i class="fas fa-clipboard-list text-jessa-maroon mr-2"></i>Tiket Keluhan</h3>
                        <a href="{{ route('admin.tickets.index') }}" class="text-xs font-bold text-gray-500 hover:text-jessa-maroon transition-colors">Lihat Semua</a>
                    </div>
                    <div class="p-0">
                        @forelse($recentTickets as $ticket)
                        <a href="{{ route('admin.tickets.index') }}" class="block p-4 border-b border-gray-50 hover:bg-gray-50/80 transition-colors last:border-0">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="font-bold text-gray-900 text-sm truncate pr-2">{{ $ticket->title }}</h4>
                                @if($ticket->status == 'open')
                                    <span class="shrink-0 px-2 py-0.5 rounded text-[10px] font-bold bg-red-50 text-red-600 border border-red-100 uppercase">Open</span>
                                @elseif($ticket->status == 'in_progress')
                                    <span class="shrink-0 px-2 py-0.5 rounded text-[10px] font-bold bg-yellow-50 text-yellow-600 border border-yellow-100 uppercase">Proses</span>
                                @else
                                    <span class="shrink-0 px-2 py-0.5 rounded text-[10px] font-bold bg-green-50 text-green-600 border border-green-100 uppercase">Selesai</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 mb-2 truncate">{{ $ticket->description }}</p>
                            <div class="flex items-center justify-between text-[11px] font-bold text-gray-400">
                                <span><i class="fas fa-user mr-1"></i> {{ $ticket->user->name ?? 'User' }} (Kmr {{ $ticket->room->room_number ?? '-' }})</span>
                                <span>{{ $ticket->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                        @empty
                        <div class="p-6 text-center text-gray-400 text-sm font-medium">
                            <i class="fas fa-check-circle text-3xl mb-2 text-green-200 block"></i>
                            Tidak ada keluhan saat ini.
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- Recent Guests --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-extrabold text-sm text-gray-900 uppercase tracking-wider"><i class="fas fa-users text-jessa-maroon mr-2"></i>Tamu Terbaru</h3>
                        <a href="{{ route('admin.guests.index') }}" class="text-xs font-bold text-gray-500 hover:text-jessa-maroon transition-colors">Lihat Semua</a>
                    </div>
                    <div class="p-0">
                        @forelse($recentGuests as $guest)
                        <div class="p-4 border-b border-gray-50 flex items-center justify-between last:border-0 hover:bg-gray-50/50 transition-colors">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <div class="w-10 h-10 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center shrink-0 text-gray-500">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="truncate">
                                    <p class="font-bold text-gray-900 text-sm truncate">{{ $guest->visitor_name }}</p>
                                    <p class="text-[11px] text-gray-500 font-medium truncate">{{ Str::limit($guest->purpose, 25) }}</p>
                                </div>
                            </div>
                            <div class="shrink-0 ml-2">
                                @if($guest->is_overnight)
                                    <span class="w-6 h-6 rounded-md bg-yellow-50 text-yellow-600 flex items-center justify-center text-xs" title="Menginap">
                                        <i class="fas fa-moon"></i>
                                    </span>
                                @else
                                    <span class="w-6 h-6 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center text-xs" title="Kunjungan">
                                        <i class="fas fa-sun"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="p-6 text-center text-gray-400 text-sm font-medium">
                            Belum ada tamu hari ini.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
