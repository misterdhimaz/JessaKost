<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Laporan Keuangan</h2>
                <p class="text-sm text-gray-400 font-medium">Rekapitulasi pendapatan dan pengeluaran kost</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Filter Bar -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6">
            <form method="GET" action="{{ route('owner.reports.index') }}" class="flex flex-col md:flex-row items-end gap-4">
                <div class="w-full md:w-auto">
                    <x-input-label for="month" value="Bulan" />
                    <select name="month" id="month" class="mt-1 block w-full md:w-48 border-gray-300 focus:border-jessa-maroon focus:ring-jessa-maroon rounded-xl shadow-sm">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ sprintf('%02d', $m) }}" {{ $month == sprintf('%02d', $m) ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 10)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-auto">
                    <x-input-label for="year" value="Tahun" />
                    <select name="year" id="year" class="mt-1 block w-full md:w-48 border-gray-300 focus:border-jessa-maroon focus:ring-jessa-maroon rounded-xl shadow-sm">
                        @foreach(range(date('Y')-2, date('Y')+1) as $y)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-auto flex gap-2">
                    <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-jessa-maroon text-white font-bold rounded-xl shadow-sm hover:bg-jessa-maroonDark transition-colors">Terapkan Filter</button>
                    <a href="{{ route('owner.reports.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors">Reset</a>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-50 rounded-full group-hover:scale-110 transition-transform"></div>
                <div class="relative z-10 flex items-center gap-4">
                    <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-0.5">Pendapatan Sewa</p>
                        <p class="text-xl font-black text-gray-900">Rp{{ number_format($totalRentIncome, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-110 transition-transform"></div>
                <div class="relative z-10 flex items-center gap-4">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-0.5">Pendapatan Listrik</p>
                        <p class="text-xl font-black text-gray-900">Rp{{ number_format($totalElectricityIncome, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full group-hover:scale-110 transition-transform"></div>
                <div class="relative z-10 flex items-center gap-4">
                    <div class="w-14 h-14 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-0.5">Total Pengeluaran</p>
                        <p class="text-xl font-black text-gray-900">Rp{{ number_format($totalExpense, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-jessa-maroon rounded-[2rem] p-6 shadow-md relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full group-hover:scale-110 transition-transform"></div>
                <div class="relative z-10 flex items-center gap-4">
                    <div class="w-14 h-14 bg-white/20 text-white backdrop-blur-sm rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-white/70 font-bold uppercase tracking-wider mb-0.5">Laba Bersih</p>
                        <p class="text-xl font-black text-white">Rp{{ number_format($netProfit, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Table Pemasukan -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="font-extrabold text-gray-900 text-lg">Rincian Pendapatan</h3>
                    <span class="text-sm font-bold text-green-600">Rp{{ number_format($totalIncome, 0, ',', '.') }}</span>
                </div>
                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">Jenis</th>
                                <th class="p-3 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium">
                            @forelse($paidBills as $bill)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50">
                                <td class="p-3 text-gray-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($bill->paid_at)->format('d M Y') }}</td>
                                <td class="p-3">
                                    <p class="font-bold text-gray-900">{{ ucfirst($bill->type) }} - Kamar {{ $bill->lease->room->room_number }}</p>
                                </td>
                                <td class="p-3 text-right font-bold text-gray-900">Rp{{ number_format($bill->amount, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="p-6 text-center text-gray-500">Tidak ada pendapatan di periode ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table Pengeluaran -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="font-extrabold text-gray-900 text-lg">Rincian Pengeluaran</h3>
                    <span class="text-sm font-bold text-red-600">Rp{{ number_format($totalExpense, 0, ',', '.') }}</span>
                </div>
                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">Kategori & Judul</th>
                                <th class="p-3 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium">
                            @forelse($expenses as $expense)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50">
                                <td class="p-3 text-gray-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}</td>
                                <td class="p-3">
                                    <p class="font-bold text-gray-900">{{ $expense->title }}</p>
                                    <span class="text-[10px] text-gray-500 uppercase">{{ $expense->category }}</span>
                                </td>
                                <td class="p-3 text-right font-bold text-gray-900">Rp{{ number_format($expense->amount, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="p-6 text-center text-gray-500">Tidak ada pengeluaran di periode ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
