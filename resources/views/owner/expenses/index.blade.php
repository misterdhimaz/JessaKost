<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Laporan Pengeluaran</h2>
                <p class="text-sm text-gray-400 font-medium">Pantau semua uang keluar yang dicatat oleh Admin</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Total Pengeluaran Bulan Ini</p>
                    <p class="text-2xl font-black text-gray-900">Rp{{ number_format($expenses->where('expense_date', '>=', now()->startOfMonth())->sum('amount'), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-gray-900 text-lg">Daftar Pengeluaran Keseluruhan</h3>
            </div>

            <div class="overflow-x-auto p-4">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Kategori & Judul</th>
                            <th class="p-4">Pencatat</th>
                            <th class="p-4 text-right">Nominal (Rp)</th>
                            <th class="p-4 text-center">Bukti Nota</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium">
                        @forelse($expenses as $expense)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="p-4 text-gray-500 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                            </td>
                            <td class="p-4">
                                <p class="font-bold text-gray-900">{{ $expense->title }}</p>
                                <span class="inline-block mt-1 px-2 py-1 bg-gray-100 text-gray-600 rounded-md text-[10px] font-bold uppercase">{{ $expense->category }}</span>
                                @if($expense->notes)
                                    <p class="text-xs text-gray-500 mt-1 truncate max-w-[200px]">{{ $expense->notes }}</p>
                                @endif
                            </td>
                            <td class="p-4 text-gray-600">
                                <i class="fas fa-user-circle mr-1"></i> {{ $expense->user->name }}
                            </td>
                            <td class="p-4 text-right">
                                <p class="font-extrabold text-jessa-maroon">Rp{{ number_format($expense->amount, 0, ',', '.') }}</p>
                            </td>
                            <td class="p-4 text-center">
                                @if($expense->proof_image_path)
                                    <a href="{{ asset('storage/' . $expense->proof_image_path) }}" target="_blank" class="text-blue-500 hover:text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg transition-colors inline-block" title="Lihat Bukti Nota">
                                        <i class="fas fa-receipt"></i>
                                    </a>
                                @else
                                    <span class="text-gray-300"><i class="fas fa-times-circle"></i></span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-500 font-medium">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto mb-3 text-2xl">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <p class="text-gray-900 font-bold text-lg mb-1">Belum Ada Pengeluaran</p>
                                <p>Belum ada catatan pengeluaran yang dibuat oleh Admin.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

