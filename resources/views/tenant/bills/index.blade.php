<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tenant.dashboard') }}" class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-receipt"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Tagihan & Pembayaran</h2>
                <p class="text-sm text-gray-400 font-medium">Kelola dan bayar tagihan Anda dengan mudah</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6" x-data="{ photoModalOpen: false, currentPhoto: '', currentCode: '' }">

        {{-- Summary Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl border border-gray-100 p-5 text-center shadow-sm relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-16 h-16 bg-red-50 rounded-full opacity-50 group-hover:scale-150 transition-transform"></div>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2 relative z-10">Belum Lunas</p>
                <p class="text-3xl font-extrabold text-red-500 relative z-10">{{ $countUnpaid }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-5 text-center shadow-sm relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-16 h-16 bg-green-50 rounded-full opacity-50 group-hover:scale-150 transition-transform"></div>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-2 relative z-10">Sudah Lunas</p>
                <p class="text-3xl font-extrabold text-green-500 relative z-10">{{ $countPaid }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-red-50 p-5 text-center shadow-sm col-span-2 relative overflow-hidden group">
                <div class="absolute -left-4 -bottom-4 w-24 h-24 bg-red-100/50 rounded-full opacity-50 group-hover:scale-150 transition-transform"></div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-2 relative z-10">Total Tunggakan</p>
                <p class="text-2xl sm:text-3xl font-extrabold text-red-600 relative z-10">Rp {{ number_format($totalUnpaid, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Filters & Search --}}
        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
            <form method="GET" action="{{ route('tenant.bills.index') }}" class="flex flex-col md:flex-row items-center gap-3 w-full">
                <div class="relative w-full md:flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari periode (misal: Sep 2026)..." class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon pl-10 pr-4 py-3 font-medium transition-colors">
                    <i class="fas fa-search absolute left-3.5 top-3.5 text-gray-400"></i>
                </div>

                <select name="type" class="w-full md:w-auto bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon py-3 pl-4 pr-10 cursor-pointer font-bold transition-colors appearance-none" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23131313%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 0.65rem auto;" onchange="this.form.submit()">
                    <option value="all">Semua Kategori</option>
                    <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>Sewa Kamar</option>
                    <option value="electricity" {{ request('type') == 'electricity' ? 'selected' : '' }}>Listrik</option>
                    <option value="internet" {{ request('type') == 'internet' ? 'selected' : '' }}>WiFi</option>
                </select>

                <select name="status" class="w-full md:w-auto bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon py-3 pl-4 pr-10 cursor-pointer font-bold transition-colors appearance-none" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23131313%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 0.65rem auto;" onchange="this.form.submit()">
                    <option value="all">Semua Status</option>
                    <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                </select>

                <button type="submit" class="w-full md:w-auto bg-jessa-maroon text-white px-5 py-3 rounded-xl text-sm font-bold hover:bg-jessa-maroonDark transition-colors shadow-sm">
                    Terapkan
                </button>
                @if(request()->anyFilled(['search', 'type', 'status']))
                    <a href="{{ route('tenant.bills.index') }}" class="w-full md:w-auto text-center bg-gray-100 text-gray-500 px-5 py-3 rounded-xl text-sm font-bold hover:bg-gray-200 transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Bill List --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between">
                <h3 class="font-extrabold text-gray-900">Riwayat Tagihan</h3>
            </div>

            <div class="divide-y divide-gray-50">
                @forelse($bills as $bill)
                <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-gray-50/50 transition-colors relative overflow-hidden group">
                    <div class="flex items-center gap-4 relative z-10">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shrink-0 bg-{{ $bill->type_color }}/10 text-{{ $bill->type_color }} shadow-sm border border-{{ $bill->type_color }}/20">
                            <i class="fas {{ $bill->type_icon }}"></i>
                        </div>
                        <div>
                            <p class="font-extrabold text-gray-900 text-lg">Tagihan {{ $bill->type_label }}</p>
                            <div class="flex flex-col gap-1.5 mt-1">
                                <div class="flex items-center gap-3 text-xs text-gray-500 font-medium bg-gray-50 px-2 py-1 rounded-md inline-flex w-fit">
                                    <span><i class="far fa-calendar-alt text-gray-400 mr-1.5"></i>Periode: {{ $bill->billing_period ?? \Carbon\Carbon::parse($bill->due_date)->translatedFormat('F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-xs text-gray-400 font-medium">
                                    <span class="text-red-500"><i class="fas fa-exclamation-circle mr-1.5"></i>Jatuh tempo: {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}</span>
                                </div>
                                @if($bill->status == 'paid')
                                <div class="text-xs text-green-600 font-bold mt-1">
                                    <i class="fas fa-check-double mr-1.5"></i>Dibayar pada: {{ $bill->paid_at ? \Carbon\Carbon::parse($bill->paid_at)->format('d M Y, H:i') : 'Telah Lunas' }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-5 sm:flex-shrink-0 relative z-10 bg-white/80 p-3 rounded-xl sm:bg-transparent sm:p-0">
                        <div class="text-right">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-0.5">Total</p>
                            <p class="font-black text-xl text-gray-900">Rp {{ number_format($bill->amount, 0, ',', '.') }}</p>
                        </div>

                        @if($bill->status == 'paid')
                            <div class="flex flex-col items-end gap-2 border-l border-gray-100 pl-4">
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 border border-green-200 px-4 py-1.5 rounded-full text-xs font-bold shadow-sm">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Lunas
                                </span>
                                @if($bill->type == 'electricity' && ($bill->token_code || $bill->token_proof_path))
                                    <button @click="currentPhoto = '{{ $bill->token_proof_path ? asset('storage/' . $bill->token_proof_path) : '' }}'; currentCode = '{{ $bill->token_code ?? '' }}'; photoModalOpen = true" class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-3 py-1.5 rounded-lg font-bold hover:bg-yellow-100 hover:scale-105 transition-all flex items-center gap-1.5 shadow-sm">
                                        <i class="fas fa-bolt text-yellow-500"></i> Lihat Token
                                    </button>
                                @endif
                            </div>
                        @else
                            <div class="border-l border-gray-100 pl-4">
                                <a href="{{ route('tenant.bills.pay', $bill->id) }}" class="bg-jessa-maroon text-white font-extrabold px-6 py-2.5 rounded-xl hover:bg-jessa-maroonDark hover:scale-105 transition-all text-sm shadow-md flex items-center gap-2 whitespace-nowrap">
                                    <i class="fas fa-credit-card"></i> Bayar
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="p-16 text-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto mb-4 text-4xl">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <p class="font-extrabold text-gray-900 text-xl mb-2">Belum Ada Tagihan</p>
                    <p class="text-gray-500 font-medium text-sm max-w-sm mx-auto">Tagihan Anda akan muncul di sini sesuai dengan filter yang dipilih.</p>
                </div>
                @endforelse
            </div>

            @if($bills->hasPages())
                <div class="p-5 border-t border-gray-50 bg-gray-50/30">
                    {{ $bills->links() }}
                </div>
            @endif
        </div>

        {{-- Token Photo Modal --}}
        <div x-show="photoModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/95 backdrop-blur-md p-4 sm:p-8 transition-all" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <button @click="photoModalOpen = false" class="absolute top-6 right-6 sm:top-10 sm:right-10 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-full w-12 h-12 flex items-center justify-center transition-all shadow-lg border border-white/10 hover:scale-105 z-50">
                <i class="fas fa-times text-xl"></i>
            </button>
            <div class="relative w-full max-w-5xl flex flex-col items-center justify-center h-full" @click.away="photoModalOpen = false" x-transition:enter="transition ease-out duration-300 delay-100" x-transition:enter-start="opacity-0 scale-95 translate-y-8" x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                <template x-if="currentCode && currentCode !== ''">
                    <div class="bg-white p-6 rounded-3xl mb-8 shadow-2xl flex flex-col items-center max-w-md w-full border border-gray-100 relative overflow-hidden group">
                        <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-jessa-maroon to-orange-500"></div>
                        <div class="absolute -right-4 -top-4 w-16 h-16 bg-yellow-50 rounded-full opacity-50 group-hover:scale-150 transition-transform"></div>
                        <i class="fas fa-bolt text-yellow-400 text-3xl mb-2 relative z-10"></i>
                        <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mb-1 relative z-10">Kode Token Listrik Anda</p>
                        <p class="text-2xl sm:text-3xl font-black text-gray-900 tracking-[0.2em] relative z-10" x-text="currentCode"></p>
                    </div>
                </template>

                <template x-if="currentPhoto && currentPhoto !== ''">
                    <div class="flex flex-col items-center">
                        <img :src="currentPhoto" class="max-h-[50vh] w-auto object-contain rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/10 transition-transform duration-300 hover:scale-[1.02]">
                        <p class="mt-6 text-white/90 font-bold text-sm text-center px-6 py-3 bg-white/10 backdrop-blur-xl rounded-full shadow-lg border border-white/10 tracking-wide">
                            <i class="fas fa-receipt mr-2 text-jessa-cream"></i> BUKTI STRUK PENGISIAN TOKEN
                        </p>
                    </div>
                </template>
            </div>
        </div>

    </div>
</x-app-layout>
