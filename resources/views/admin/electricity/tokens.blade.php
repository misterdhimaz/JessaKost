<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">Pengisian Token Listrik</h2>
                    <p class="text-sm text-gray-500 font-medium mt-1">Unggah bukti pengisian token untuk tagihan listrik yang sudah dibayar</p>
                </div>
            </div>
            <a href="{{ route('admin.electricity.input') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-4 py-2 rounded-xl transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Pencatatan
            </a>
        </div>
    </x-slot>

    <div class="space-y-6" x-data="{ photoModalOpen: false, currentPhoto: '' }">
        
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl font-bold flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-lg text-gray-900">Tagihan Listrik (Lunas)</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-50">
                            <th class="p-4">Tanggal Bayar</th>
                            <th class="p-4">Kamar / Penghuni</th>
                            <th class="p-4">Nominal Tagihan</th>
                            <th class="p-4">Status Token</th>
                            <th class="p-4 text-right">Aksi Upload</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium">
                        @forelse($paidElectricityBills as $bill)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($bill->paid_at)->translatedFormat('d M Y, H:i') }}</td>
                            <td class="p-4">
                                <p class="font-bold text-gray-900">Kamar {{ $bill->lease->room->room_number ?? '-' }}</p>
                                <p class="text-xs text-gray-500">{{ $bill->lease->user->name ?? '-' }}</p>
                            </td>
                            <td class="p-4 font-bold text-gray-900">Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                            <td class="p-4">
                                @if($bill->token_code)
                                    <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-100">
                                        <i class="fas fa-check-circle"></i> Token Terisi
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold border border-yellow-100">
                                        <i class="fas fa-clock"></i> Menunggu Diisi
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                @if($bill->token_code)
                                    <button @click="currentPhoto = '{{ asset('storage/' . $bill->token_proof_path) }}'; photoModalOpen = true" class="text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 hover:bg-blue-100 font-bold text-xs">
                                        Lihat Bukti
                                    </button>
                                @else
                                    <div x-data="{ uploadOpen: false }" class="relative inline-block text-left">
                                        <button @click="uploadOpen = !uploadOpen" class="text-white bg-jessa-maroon px-4 py-2 rounded-xl font-bold text-xs hover:bg-jessa-maroonDark transition-colors">
                                            Isi Token
                                        </button>
                                        
                                        {{-- Dropdown Form Upload --}}
                                        <div x-show="uploadOpen" @click.away="uploadOpen = false" class="absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 p-4 z-50 text-left">
                                            <form action="{{ route('admin.electricity.upload_token', $bill) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                                @csrf
                                                <p class="font-bold text-gray-900 text-sm border-b pb-2">Upload Bukti Token</p>
                                                
                                                <div>
                                                    <label class="block text-xs font-bold text-gray-500 mb-1">Kode Token PLN</label>
                                                    <input type="text" name="token_code" required class="w-full text-sm border border-gray-200 rounded-lg p-2 focus:ring-jessa-maroon focus:border-jessa-maroon" placeholder="Ex: 1234-5678-9012-3456">
                                                </div>
                                                
                                                <div>
                                                    <label class="block text-xs font-bold text-gray-500 mb-1">Foto Struk / Bukti</label>
                                                    <input type="file" name="token_proof" required accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-jessa-maroon/10 file:text-jessa-maroon hover:file:bg-jessa-maroon/20">
                                                </div>
                                                
                                                <button type="submit" class="w-full bg-jessa-maroon text-white font-bold text-sm py-2 rounded-xl hover:bg-jessa-maroonDark transition-colors">
                                                    Simpan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-400 font-medium">Belum ada tagihan listrik yang sudah lunas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Lightbox Photo Viewer --}}
        <div x-show="photoModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/95 backdrop-blur-md p-4 sm:p-8 transition-all">
            <button @click="photoModalOpen = false" class="absolute top-6 right-6 sm:top-10 sm:right-10 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 rounded-full w-12 h-12 flex items-center justify-center transition-all shadow-lg border border-white/10 hover:scale-105 z-50">
                <i class="fas fa-times text-xl"></i>
            </button>
            <div class="relative w-full max-w-5xl flex flex-col items-center justify-center h-full" @click.away="photoModalOpen = false">
                <img :src="currentPhoto" class="max-h-[75vh] w-auto object-contain rounded-2xl shadow-2xl border border-white/10">
                <p class="mt-8 text-white/90 font-bold text-sm text-center px-6 py-3 bg-white/10 backdrop-blur-xl rounded-full shadow-lg border border-white/10">BUKTI PENGISIAN TOKEN</p>
            </div>
        </div>

    </div>
</x-app-layout>
