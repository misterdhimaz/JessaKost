<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('owner.dashboard') }}" class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                    <i class="fas fa-file-invoice-dollar text-lg"></i>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">Laporan Keuangan</h2>
                    <p class="text-sm text-gray-500 font-medium mt-1">Rekapitulasi pembayaran lunas (Sewa & Listrik)</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        
        {{-- Filter & Total Card --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 bg-gradient-to-br from-jessa-maroon to-jessa-maroonDark rounded-3xl p-6 shadow-md text-white relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 opacity-10 text-9xl">
                    <i class="fas fa-wallet"></i>
                </div>
                <p class="text-white/70 font-bold text-xs uppercase tracking-widest mb-1 relative z-10">Total Pendapatan (Berdasarkan Filter)</p>
                <h3 class="font-black text-4xl mb-4 relative z-10">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                <p class="text-white/80 text-sm font-medium relative z-10"><i class="fas fa-check-circle text-green-400 mr-1"></i> Dari {{ $paidBills->count() }} transaksi lunas</p>
            </div>

            <div class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col justify-center">
                <form action="{{ route('owner.reports.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4 w-full">
                    <div class="w-full">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Bulan Pembayaran</label>
                        <select name="month" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon p-3 font-medium">
                            <option value="">-- Semua Bulan --</option>
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tahun Pembayaran</label>
                        <select name="year" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon p-3 font-medium">
                            <option value="">-- Semua Tahun --</option>
                            @foreach(range(date('Y') - 2, date('Y')) as $y)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full md:w-auto px-6 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-black transition-colors whitespace-nowrap">
                        <i class="fas fa-filter mr-2"></i> Filter Data
                    </button>
                    @if(request('month') || request('year'))
                        <a href="{{ route('owner.reports.index') }}" class="w-full md:w-auto px-6 py-3 bg-red-50 text-red-600 font-bold rounded-xl hover:bg-red-100 transition-colors text-center whitespace-nowrap">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Detailed Table --}}
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between">
                <h3 class="font-extrabold text-gray-900">Rincian Transaksi Masuk</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-50 bg-white">
                            <th class="p-5">Tanggal Bayar</th>
                            <th class="p-5">Penyewa / Kamar</th>
                            <th class="p-5">Jenis Tagihan</th>
                            <th class="p-5">Periode</th>
                            <th class="p-5 text-right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium divide-y divide-gray-50">
                        @forelse($paidBills as $bill)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="p-5 text-gray-500">{{ \Carbon\Carbon::parse($bill->paid_at)->translatedFormat('d M Y, H:i') }}</td>
                            <td class="p-5">
                                <p class="font-bold text-gray-900">{{ $bill->lease->user->name ?? '-' }}</p>
                                <p class="text-xs text-gray-400">Kamar {{ $bill->lease->room->room_number ?? '-' }}</p>
                            </td>
                            <td class="p-5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-{{ $bill->type_color }}/10 text-{{ $bill->type_color }} rounded-full text-xs font-bold border border-{{ $bill->type_color }}/20">
                                    <i class="fas {{ $bill->type_icon }}"></i> {{ $bill->type_label }}
                                </span>
                            </td>
                            <td class="p-5 text-gray-500">{{ $bill->billing_period ?? \Carbon\Carbon::parse($bill->due_date)->translatedFormat('F Y') }}</td>
                            <td class="p-5 text-right font-black text-gray-900">Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-16 text-center text-gray-400 font-medium">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto mb-4 text-2xl">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <p class="text-lg font-bold text-gray-900 mb-1">Tidak ada data transaksi.</p>
                                <p class="text-sm">Belum ada pembayaran yang lunas pada periode ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
