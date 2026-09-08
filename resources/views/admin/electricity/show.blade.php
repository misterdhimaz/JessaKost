<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.electricity.index') }}" class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-jessa-maroon hover:border-jessa-maroon/30 flex items-center justify-center transition-colors shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">Detail Tagihan Listrik</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Kamar {{ $bill->lease->room->room_number ?? '-' }} - {{ \Carbon\Carbon::parse($bill->billing_period)->translatedFormat('F Y') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Detail Tagihan & Meteran --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i class="fas fa-file-invoice-dollar text-xl"></i>
                    </div>
                    <h3 class="font-extrabold text-lg text-gray-900">Rincian Tagihan</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Penyewa</p>
                            <p class="font-semibold text-gray-900">{{ $bill->lease->user->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Periode Tagihan</p>
                            <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($bill->billing_period)->translatedFormat('F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Status Pembayaran</p>
                            @if($bill->status == 'paid')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-sm font-bold bg-green-50 text-green-700 border border-green-100">
                                <i class="fas fa-check-circle"></i> Lunas
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-sm font-bold bg-red-50 text-red-700 border border-red-100">
                                <i class="fas fa-clock"></i> Belum Dibayar
                            </span>
                            @endif
                        </div>
                    </div>

                    @if($reading)
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center border-b border-gray-200 pb-2">
                                <span class="text-sm font-medium text-gray-500">Angka Meteran</span>
                                <span class="font-bold text-gray-900">{{ $reading->kwh_used }} kWh</span>
                            </div>
                            <div class="flex justify-between items-center pt-1">
                                <span class="text-sm font-bold text-gray-900">Total Biaya</span>
                                <span class="font-extrabold text-lg text-jessa-maroon">Rp {{ number_format($bill->amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 flex items-center justify-center text-gray-400 text-sm">
                        Data pencatatan tidak tersedia.
                    </div>
                    @endif
                </div>
            </div>

            @if($reading && $reading->image_path)
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-extrabold text-lg text-gray-900 mb-4">Foto Bukti Meteran</h3>
                <div class="rounded-2xl overflow-hidden border border-gray-100">
                    <img src="{{ Storage::url($reading->image_path) }}" alt="Foto Meteran" class="w-full max-h-96 object-contain bg-gray-50">
                </div>
            </div>
            @endif
        </div>

        {{-- Panel Token Listrik --}}
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-jessa-maroon to-jessa-maroonDark rounded-3xl shadow-lg border border-jessa-maroon/20 p-1 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
                <div class="bg-white/95 backdrop-blur-xl rounded-[22px] p-6 relative z-10 h-full">

                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-yellow-50 text-yellow-600 flex items-center justify-center">
                            <i class="fas fa-bolt text-xl"></i>
                        </div>
                        <h3 class="font-extrabold text-lg text-gray-900">Token Listrik</h3>
                    </div>

                    @if($bill->status == 'paid')
                        @if($bill->token_code || $bill->token_proof_path)
                            <div class="space-y-4">
                                <div class="bg-green-50 text-green-700 p-3 rounded-xl text-sm font-medium border border-green-100 flex items-start gap-2">
                                    <i class="fas fa-check-circle mt-0.5"></i>
                                    <p>Token telah diinput dan dikirimkan ke penghuni.</p>
                                </div>

                                @if($bill->token_code)
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Kode Token</p>
                                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
                                        <span class="font-mono font-extrabold text-2xl tracking-widest text-gray-900">{{ $bill->token_code }}</span>
                                    </div>
                                </div>
                                @endif

                                @if($bill->token_proof_path)
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Bukti Pembelian / Struk</p>
                                    <div class="rounded-xl overflow-hidden border border-gray-200 bg-gray-50">
                                        <img src="{{ Storage::url($bill->token_proof_path) }}" alt="Bukti Token" class="w-full h-auto">
                                    </div>
                                </div>
                                @endif
                            </div>
                        @else
                            <form action="{{ route('admin.electricity.upload_token', $bill->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div class="bg-blue-50 text-blue-700 p-3 rounded-xl text-sm font-medium border border-blue-100 flex items-start gap-2">
                                    <i class="fas fa-info-circle mt-0.5"></i>
                                    <p>Penghuni telah membayar tagihan. Silakan input kode token atau upload struk pembelian.</p>
                                </div>

                                <div>
                                    <label for="token_code" class="block text-sm font-bold text-gray-700 mb-1">Kode Token <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                    <input type="text" name="token_code" id="token_code" class="w-full rounded-xl border-gray-200 focus:border-jessa-maroon focus:ring focus:ring-jessa-maroon/20 font-mono tracking-widest text-center text-lg" placeholder="XXXX-XXXX-XXXX-XXXX">
                                </div>

                                <div>
                                    <label for="token_proof" class="block text-sm font-bold text-gray-700 mb-1">Upload Struk Token <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                    <input type="file" name="token_proof" id="token_proof" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-jessa-maroon/10 file:text-jessa-maroon hover:file:bg-jessa-maroon/20">
                                </div>

                                <button type="submit" class="w-full mt-2 bg-jessa-maroon hover:bg-jessa-maroonDark text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-sm shadow-jessa-maroon/30 hover:-translate-y-0.5 flex justify-center items-center gap-2">
                                    <i class="fas fa-paper-plane"></i> Simpan Token
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center text-2xl mx-auto mb-4 border border-gray-200">
                                <i class="fas fa-lock"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Belum Bisa Input Token</h4>
                            <p class="text-sm text-gray-500">Token hanya dapat diinput setelah penghuni melunasi tagihan listrik bulan ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

