<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tenant.dashboard') }}" class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-receipt"></i>
            </div>
            <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Tagihan & Pembayaran</h2>
        </div>
    </x-slot>

    <div class="space-y-6">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $totalUnpaid = $bills->where('status', 'unpaid')->sum('amount');
                    $countUnpaid = $bills->where('status', 'unpaid')->count();
                    $countPaid   = $bills->where('status', 'paid')->count();
                @endphp
                <div class="bg-white rounded-2xl border border-gray-100 p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">Belum Lunas</p>
                    <p class="text-3xl font-extrabold text-red-500">{{ $countUnpaid }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-5 text-center shadow-sm">
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">Sudah Lunas</p>
                    <p class="text-3xl font-extrabold text-green-500">{{ $countPaid }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-red-50 p-5 text-center shadow-sm col-span-2">
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">Total Tunggakan</p>
                    <p class="text-2xl font-extrabold text-red-500">Rp {{ number_format($totalUnpaid, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Bill List --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between">
                    <h3 class="font-extrabold text-gray-900">Riwayat Semua Tagihan</h3>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse($bills as $bill)
                    <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0 bg-{{ $bill->type_color }}/10 text-{{ $bill->type_color }}">
                                <i class="fas {{ $bill->type_icon }}"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Tagihan {{ $bill->type_label }}</p>
                                <div class="flex flex-col gap-1 mt-1">
                                    <div class="flex items-center gap-3 text-xs text-gray-400 font-medium">
                                        <span><i class="far fa-calendar-alt mr-1"></i> Periode: {{ $bill->billing_period ?? \Carbon\Carbon::parse($bill->due_date)->translatedFormat('F Y') }}</span>
                                        <span><i class="fas fa-exclamation-circle mr-1"></i> Jatuh tempo: {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}</span>
                                    </div>
                                    @if($bill->status == 'paid')
                                    <div class="text-xs text-green-600 font-bold">
                                        <i class="fas fa-check-double mr-1"></i> Dibayar pada: {{ $bill->paid_at ? \Carbon\Carbon::parse($bill->paid_at)->format('d M Y, H:i') : 'Telah Lunas' }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 sm:flex-shrink-0">
                            <p class="font-extrabold text-lg text-gray-900">Rp {{ number_format($bill->amount, 0, ',', '.') }}</p>
                            @if($bill->status == 'paid')
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 border border-green-100 px-3 py-1.5 rounded-full text-xs font-bold">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Lunas
                                </span>
                            @else
                                <a href="{{ $bill->payment_url ?? '#' }}" class="bg-jessa-maroon text-white font-bold px-5 py-2 rounded-xl hover:bg-jessa-maroonDark transition-colors text-sm shadow-sm whitespace-nowrap">
                                    <i class="fas fa-credit-card mr-2"></i>Bayar
                                </a>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="p-16 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto mb-4 text-3xl">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <p class="font-bold text-gray-900 text-lg mb-1">Belum Ada Tagihan</p>
                        <p class="text-gray-400 font-medium text-sm">Tagihan Anda akan muncul di sini setelah diproses oleh Admin.</p>
                    </div>
                    @endforelse
                </div>
            </div>

    </div>
</x-app-layout>

