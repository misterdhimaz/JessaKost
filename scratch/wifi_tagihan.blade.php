        <!-- Daftar Tagihan WiFi -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden mt-8">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-jessa-maroon/10 text-jessa-maroon rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-invoice-dollar text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-gray-900 text-lg">Daftar Tagihan WiFi</h3>
                        <p class="text-sm text-gray-500 font-medium">Riwayat tagihan internet penghuni</p>
                    </div>
                </div>

                <!-- Filter & Search Form -->
                <form method="GET" action="{{ route('admin.wifi.index') }}" class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                    <select name="status" class="w-full sm:w-auto bg-white border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon py-2.5 px-4 font-bold" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                    </select>
                    
                    <div class="relative w-full sm:w-64">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari penghuni..." class="w-full bg-white border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon pl-10 pr-4 py-2.5 font-medium">
                        <i class="fas fa-search absolute left-3.5 top-3 text-gray-400"></i>
                    </div>
                    
                    <button type="submit" class="hidden"></button>
                </form>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($internetBills as $bill)
                    <div class="border border-gray-100 rounded-2xl p-5 hover:shadow-md transition-all group bg-white relative overflow-hidden">
                        @if($bill->status == 'paid')
                        <div class="absolute top-0 right-0 w-16 h-16 overflow-hidden rounded-tr-2xl">
                            <div class="bg-green-500 text-white text-[10px] font-black uppercase tracking-wider py-1 w-24 text-center absolute top-3 -right-6 rotate-45 shadow-sm">
                                LUNAS
                            </div>
                        </div>
                        @endif

                        <div class="flex items-center gap-4 mb-4 relative z-10">
                            <div class="w-12 h-12 bg-jessa-maroon/10 text-jessa-maroon rounded-xl flex items-center justify-center text-xl font-bold">
                                {{ $bill->lease->room->room_number ?? '?' }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $bill->lease->user->name ?? 'Penghuni' }}</h4>
                                <p class="text-xs text-gray-500 font-medium">Periode: {{ \Carbon\Carbon::parse($bill->billing_period)->translatedFormat('F Y') }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100 relative z-10">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-0.5">Total Tagihan</p>
                                <p class="font-black text-jessa-maroon text-lg">Rp {{ number_format($bill->amount, 0, ',', '.') }}</p>
                            </div>
                            @if($bill->status == 'unpaid')
                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-bold border border-red-100">
                                <i class="fas fa-clock mr-1"></i> Belum Bayar
                            </span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-10 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-3xl text-gray-400 mx-auto mb-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4 class="font-extrabold text-gray-900 text-lg mb-1">Belum Ada Tagihan</h4>
                        <p class="text-gray-500 font-medium text-sm">Tidak ada tagihan WiFi yang sesuai.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
