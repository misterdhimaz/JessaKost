<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-chart-line text-lg"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">Ringkasan Eksekutif</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Performa bisnis dan operasional kost terkini.</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl font-bold flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Hero Banner --}}
        <div class="relative bg-gradient-to-r from-gray-900 via-gray-800 to-jessa-maroon rounded-[2.5rem] p-8 md:p-12 overflow-hidden shadow-2xl shadow-gray-900/20 group">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full filter blur-3xl transform translate-x-1/2 -translate-y-1/2 group-hover:scale-150 transition-transform duration-1000"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-jessa-maroon opacity-20 rounded-full filter blur-2xl transform -translate-x-1/2 translate-y-1/2 group-hover:scale-150 transition-transform duration-1000"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <span class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/20 text-white/90 text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm shadow-sm">
                        <i class="fas fa-chart-line text-blue-300 mr-1"></i> Ringkasan Eksekutif
                    </span>
                    <h2 class="text-3xl md:text-5xl font-black text-white mb-2 tracking-tight">Halo, Bos {{ explode(' ', Auth::user()->name)[0] }}! <span class="animate-wave inline-block origin-bottom-right">👋</span></h2>
                    <p class="text-white/80 font-medium text-sm md:text-base max-w-xl">Laporan performa bisnis dan kesehatan finansial Kost Jessa secara real-time.</p>
                </div>

                <div class="hidden md:flex gap-3">
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 text-center text-white min-w-[120px]">
                        <p class="text-3xl font-black">{{ $occupancyRate }}%</p>
                        <p class="text-[10px] uppercase tracking-wider opacity-80 font-bold mt-1">Okupansi</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Finance & Operational KPIs --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Total Pemasukan --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out"></div>
                <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-2xl shrink-0 relative z-10">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Total Pemasukan</p>
                    <p class="text-2xl font-black text-gray-900 leading-none">Rp {{ number_format($income, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Tunggakan --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out"></div>
                <div class="w-14 h-14 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-2xl shrink-0 relative z-10">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Tunggakan ({{ $unpaidRent }})</p>
                    <p class="text-2xl font-black text-red-600 leading-none">Rp {{ number_format($unpaidAmount, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Okupansi Kamar --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out"></div>
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shrink-0 relative z-10">
                    <i class="fas fa-door-open"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Kamar Terisi</p>
                    <p class="text-2xl font-black text-gray-900 leading-none">{{ $occupiedRooms }} <span class="text-lg text-gray-400 font-bold">/ {{ $totalRooms }}</span></p>
                </div>
            </div>

            {{-- Approval --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-orange-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out"></div>
                <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center text-2xl shrink-0 relative z-10">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Butuh Persetujuan</p>
                    <p class="text-2xl font-black text-gray-900 leading-none">{{ $pendingApprovals->count() }} <span class="text-lg text-gray-400 font-bold">Tiket</span></p>
                </div>
            </div>
        </div>

        {{-- Main Sections --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Approval Section --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 lg:col-span-2 overflow-hidden flex flex-col">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between">
                    <h3 class="font-extrabold text-gray-900 text-lg flex items-center gap-2">
                        <i class="fas fa-clipboard-check text-orange-500"></i> Persetujuan Dana Operasional
                    </h3>
                </div>
                <div class="p-6 flex-1 space-y-4 bg-white">
                    @if($pendingApprovals->isEmpty())
                        <div class="flex flex-col items-center justify-center h-full text-center space-y-3 py-8">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 text-2xl">
                                <i class="fas fa-check"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Tidak ada pengajuan dana yang membutuhkan persetujuan Anda saat ini.</p>
                        </div>
                    @else
                        @foreach($pendingApprovals as $ticket)
                        <div class="border border-gray-100 rounded-2xl p-5 bg-orange-50/30 hover:bg-orange-50 transition-colors flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="bg-orange-100 text-orange-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">Menunggu Persetujuan</span>
                                    <span class="text-xs text-gray-500 font-medium"><i class="far fa-clock"></i> {{ $ticket->created_at->diffForHumans() }}</span>
                                </div>
                                <h4 class="font-extrabold text-gray-900 text-lg mb-1">{{ $ticket->title }}</h4>
                                <p class="text-sm text-gray-600 mb-2">{{ $ticket->description }}</p>
                                <p class="text-xs text-gray-500 font-bold"><i class="fas fa-user text-gray-400 mr-1"></i> {{ $ticket->user->name }} &bull; Kamar {{ $ticket->room->room_number ?? '-' }}</p>
                            </div>

                            <div class="flex flex-col items-end gap-3 shrink-0 border-t border-orange-100 pt-4 md:border-t-0 md:pt-0">
                                <div class="text-right">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Estimasi Biaya</p>
                                    <p class="text-2xl font-black text-jessa-maroon">Rp {{ number_format($ticket->cost, 0, ',', '.') }}</p>
                                </div>
                                <div class="flex gap-2 w-full justify-end">
                                    <form action="{{ route('owner.tickets.reject', $ticket) }}" method="POST">
                                        @csrf
                                        <button class="bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 font-bold py-2 px-4 rounded-xl text-sm transition-colors w-full md:w-auto">Tolak</button>
                                    </form>
                                    <form action="{{ route('owner.tickets.approve', $ticket) }}" method="POST">
                                        @csrf
                                        <button class="bg-green-500 text-white hover:bg-green-600 font-bold py-2 px-6 rounded-xl text-sm transition-colors shadow-sm w-full md:w-auto"><i class="fas fa-check mr-1"></i> Setujui Dana</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- Quick Links / Actions --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 flex flex-col">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="font-extrabold text-gray-900 text-lg">Akses Cepat</h3>
                </div>
                <div class="p-4 space-y-2">
                    <a href="{{ route('owner.reports.index') }}" class="flex items-center gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors group">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Laporan Keuangan</p>
                            <p class="text-xs text-gray-500 font-medium">Rekapitulasi pendapatan kost</p>
                        </div>
                        <i class="fas fa-chevron-right ml-auto text-gray-300"></i>
                    </a>

                    <a href="{{ route('owner.users.index') }}" class="flex items-center gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors group">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Manajemen Pengguna</p>
                            <p class="text-xs text-gray-500 font-medium">Kelola akses Admin & Tenant</p>
                        </div>
                        <i class="fas fa-chevron-right ml-auto text-gray-300"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
