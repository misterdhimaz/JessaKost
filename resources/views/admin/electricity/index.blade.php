<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon border border-jessa-maroon/20">
                    <i class="fas fa-bolt text-xl"></i>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">Manajemen Listrik</h2>
                    <p class="text-sm text-gray-500 font-medium mt-1">Kelola tagihan dan token listrik penghuni</p>
                </div>
            </div>
            <div>
                <a href="{{ route('admin.electricity.create') }}" class="inline-flex items-center gap-2 bg-jessa-maroon hover:bg-jessa-maroonDark text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm shadow-jessa-maroon/30 transition-all hover:-translate-y-0.5">
                    <i class="fas fa-plus"></i> Input Listrik Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h3 class="font-extrabold text-lg text-gray-900 flex items-center gap-2">
                    <i class="fas fa-list text-jessa-maroon"></i> Daftar Tagihan Listrik
                </h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($electricityBills as $bill)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-5 relative overflow-hidden group">
                        @if($bill->status == 'paid')
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                        @else
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                        @endif

                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">Kamar {{ $bill->lease->room->room_number ?? '-' }}</h4>
                                <p class="text-sm text-gray-500">{{ $bill->lease->user->name ?? 'Tanpa Penghuni' }}</p>
                            </div>
                            <div>
                                @if($bill->status == 'paid')
                                <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-green-50 text-green-600 border border-green-100 flex items-center gap-1">
                                    <i class="fas fa-check-circle"></i> Lunas
                                </span>
                                @else
                                <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-red-50 text-red-600 border border-red-100 flex items-center gap-1">
                                    <i class="fas fa-clock"></i> Belum Bayar
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2 mb-5 relative z-10">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500"><i class="fas fa-calendar-alt w-5 text-center"></i> Periode</span>
                                <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($bill->billing_period)->translatedFormat('F Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500"><i class="fas fa-money-bill-wave w-5 text-center"></i> Total</span>
                                <span class="font-bold text-jessa-maroon">Rp {{ number_format($bill->amount, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="relative z-10">
                            <a href="{{ route('admin.electricity.show', $bill->id) }}" class="w-full inline-flex justify-center items-center gap-2 bg-gray-50 hover:bg-gray-100 text-gray-700 px-4 py-2 rounded-xl text-sm font-bold transition-colors border border-gray-200">
                                <i class="fas fa-eye"></i> Detail & Token
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center text-2xl mx-auto mb-4 border border-gray-100">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">Belum Ada Data</h3>
                        <p class="text-gray-500 text-sm">Belum ada tagihan listrik yang tercatat dalam sistem.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $electricityBills->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

