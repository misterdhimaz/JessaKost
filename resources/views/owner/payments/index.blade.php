<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Manajemen Pembayaran Sewa</h2>
                <p class="text-sm text-gray-400 font-medium">Pantau pembayaran sewa bulanan penyewa dan status tagihannya</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-gray-900 text-lg">Daftar Penyewaan Kamar</h3>
            </div>

            <div class="overflow-x-auto p-4">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                            <th class="p-4">Kamar</th>
                            <th class="p-4">Penghuni</th>
                            <th class="p-4">Status Sewa</th>
                            <th class="p-4">Status Tagihan Terakhir (Sewa)</th>
                            <th class="p-4 text-right">Harga Sewa (Rp)</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium">
                        @forelse($leases as $lease)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="p-4">
                                <span class="inline-flex items-center justify-center w-10 h-10 bg-gray-100 rounded-xl text-gray-900 font-black">
                                    {{ $lease->room->room_number }}
                                </span>
                            </td>
                            <td class="p-4">
                                <p class="font-bold text-gray-900">{{ $lease->user->name }}</p>
                                <p class="text-xs text-gray-500 mt-1"><i class="fas fa-calendar mr-1"></i> Mulai: {{ \Carbon\Carbon::parse($lease->start_date)->format('d M Y') }}</p>
                            </td>
                            <td class="p-4">
                                @if($lease->is_active)
                                    <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1.5 rounded-full text-xs font-bold border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-gray-50 text-gray-600 px-3 py-1.5 rounded-full text-xs font-bold border border-gray-200">
                                        Selesai / Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="p-4">
                                @php
                                    $latestRentBill = $lease->bills->where('type', 'rent')->sortByDesc('created_at')->first();
                                @endphp

                                @if($latestRentBill)
                                    @if($latestRentBill->status == 'paid')
                                        <p class="font-bold text-green-600"><i class="fas fa-check-circle mr-1"></i> Lunas</p>
                                        <p class="text-xs text-gray-500 mt-1">Via Mayar/Sistem ({{ $latestRentBill->billing_period }})</p>
                                    @else
                                        <p class="font-bold text-red-600"><i class="fas fa-times-circle mr-1"></i> Belum Dibayar</p>
                                        <p class="text-xs text-gray-500 mt-1">Periode: {{ $latestRentBill->billing_period }}</p>
                                    @endif
                                @else
                                    <p class="text-gray-400 italic text-xs">Belum ada tagihan sewa tercatat.</p>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <p class="font-extrabold text-jessa-maroon">Rp{{ number_format($lease->room->price_per_month, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 mt-1">/ bulan</p>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-500 font-medium">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto mb-3 text-2xl">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <p class="text-gray-900 font-bold text-lg mb-1">Belum Ada Data</p>
                                <p>Belum ada penyewaan kamar saat ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

