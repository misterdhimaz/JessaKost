<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-home"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Beranda Saya</h2>
                <p class="text-sm text-gray-400 font-medium">Selamat datang kembali!</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">

        {{-- ─── Status Kamar Banner ─── --}}
        @if($lease)
        <div class="bg-jessa-maroon rounded-3xl overflow-hidden relative">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 24px 24px;"></div>
            <div class="relative z-10 p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div>
                    <span class="inline-flex items-center gap-2 bg-green-400/20 text-green-300 border border-green-400/30 px-3 py-1 rounded-full text-xs font-bold mb-4">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span> Kontrak Aktif
                    </span>
                    <h3 class="text-3xl font-extrabold text-white tracking-tight">Kamar {{ $lease->room?->room_number ?? '-' }}</h3>
                    <p class="text-jessa-cream/80 font-medium mt-1">Jessa Kost · Indralaya, Ogan Ilir</p>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full md:w-auto">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl px-5 py-4 border border-white/10 text-center">
                        <p class="text-white/60 text-xs font-bold uppercase tracking-widest mb-1">Kontrak Hingga</p>
                        <p class="text-white font-extrabold text-lg">{{ \Carbon\Carbon::parse($lease->end_date)->format('d M Y') }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl px-5 py-4 border border-white/10 text-center">
                        <p class="text-white/60 text-xs font-bold uppercase tracking-widest mb-1">Sewa Bulanan</p>
                        <p class="text-white font-extrabold text-lg">Rp {{ number_format($lease->room?->price_per_month ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-3xl border border-yellow-100 p-8 flex items-center gap-6 shadow-sm">
            <div class="w-16 h-16 bg-yellow-50 rounded-2xl flex items-center justify-center text-yellow-500 text-2xl shrink-0">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div>
                <h3 class="font-extrabold text-gray-900 text-xl mb-1">Kamar Belum Ditetapkan</h3>
                <p class="text-gray-500 font-medium">Anda belum memiliki kontrak sewa aktif. Hubungi Admin atau Pemilik kost untuk informasi lebih lanjut.</p>
            </div>
        </div>
        @endif

        {{-- ─── Tagihan Belum Lunas + Quick Menu ─── --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-extrabold text-lg text-gray-900"><i class="fas fa-file-invoice-dollar text-red-400 mr-2"></i>Tagihan Menunggu</h3>
                    <a href="{{ route('tenant.bills.index') }}" class="text-sm font-bold text-jessa-maroon hover:underline">Lihat Semua →</a>
                </div>

                @forelse($bills as $bill)
                <div class="bg-white rounded-2xl border border-red-100 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-{{ $bill->type_color }}/10 rounded-xl flex items-center justify-center text-{{ $bill->type_color }} text-xl shrink-0">
                            <i class="fas {{ $bill->type_icon }}"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-lg">Rp {{ number_format($bill->amount, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500 font-medium">Tagihan {{ $bill->type_label }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 sm:flex-shrink-0">
                        <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 border border-red-100 px-3 py-1 rounded-full text-xs font-bold">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span> Belum Lunas
                        </span>
                        <a href="#" class="bg-jessa-maroon text-white font-bold px-4 py-2 rounded-xl hover:bg-jessa-maroonDark transition-colors text-sm shadow-sm">
                            Bayar
                        </a>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl border border-green-100 p-8 text-center shadow-sm">
                    <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center text-3xl text-green-400 mx-auto mb-3">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h4 class="font-extrabold text-gray-900 text-lg mb-1">Semua Tagihan Lunas! 🎉</h4>
                    <p class="text-gray-500 font-medium text-sm">Tidak ada tagihan yang menunggu pembayaran.</p>
                </div>
                @endforelse
            </div>

            {{-- Quick Info Cards --}}
            <div class="space-y-4">
                <h3 class="font-extrabold text-lg text-gray-900"><i class="fas fa-star text-yellow-400 mr-2"></i>Info Penting</h3>

                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 bg-purple-50 rounded-lg flex items-center justify-center text-purple-500"><i class="fas fa-wifi"></i></div>
                        <p class="font-bold text-gray-900 text-sm">WiFi Kost</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-0.5">SSID & Password</p>
                        <p class="text-jessa-maroon font-extrabold">JessaKost_5G</p>
                        <p class="text-gray-600 font-mono text-sm">jessa2024</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500"><i class="fas fa-phone-alt"></i></div>
                        <p class="font-bold text-gray-900 text-sm">Kontak Darurat</p>
                    </div>
                    <p class="text-gray-800 font-extrabold text-lg">0812-3456-7890</p>
                    <p class="text-xs text-gray-400 font-medium">Bapak Joko (Pengelola)</p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 bg-yellow-50 rounded-lg flex items-center justify-center text-yellow-500"><i class="fas fa-utensils"></i></div>
                        <p class="font-bold text-gray-900 text-sm">Warung & Makan</p>
                    </div>
                    <p class="text-gray-700 font-semibold text-sm">Buka 07.00 – 21.00</p>
                    <p class="text-xs text-green-600 font-bold mt-1">🎉 Es teh gratis tiap Jumat!</p>
                </div>

                <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center justify-center gap-2 w-full bg-green-50 text-green-700 border border-green-100 font-bold py-3.5 px-4 rounded-2xl hover:bg-green-500 hover:text-white transition-all text-sm shadow-sm">
                    <i class="fab fa-whatsapp text-lg"></i> Chat Admin via WhatsApp
                </a>
            </div>
        </div>

        {{-- Quick Access Section --}}
        <div class="mt-8">
            <h3 class="font-extrabold text-lg text-gray-900 mb-4"><i class="fas fa-bolt text-jessa-maroon mr-2"></i>Akses Cepat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('tenant.profile.edit') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-white border border-gray-100 shadow-sm hover:border-jessa-maroon/30 hover:bg-jessa-cream/30 transition-all group">
                    <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-500 group-hover:bg-jessa-maroon group-hover:text-white transition-colors shrink-0">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm">Pengaturan Profil</h4>
                        <p class="text-xs text-gray-400 font-medium">Data diri & identitas</p>
                    </div>
                </a>

                <a href="{{ route('tenant.guests.create') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-white border border-gray-100 shadow-sm hover:border-blue-500/30 hover:bg-blue-50 transition-all group">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors shrink-0">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm">Buku Tamu</h4>
                        <p class="text-xs text-gray-400 font-medium">Lapor tamu menginap</p>
                    </div>
                </a>

                <a href="{{ route('tenant.announcements.index') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-white border border-gray-100 shadow-sm hover:border-yellow-500/30 hover:bg-yellow-50 transition-all group">
                    <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-500 group-hover:bg-yellow-500 group-hover:text-white transition-colors shrink-0">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm">Pengumuman</h4>
                        <p class="text-xs text-gray-400 font-medium">Info terbaru kost</p>
                    </div>
                </a>

                <a href="{{ route('tenant.tickets.create') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-white border border-gray-100 shadow-sm hover:border-red-500/30 hover:bg-red-50 transition-all group">
                    <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-colors shrink-0">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm">Lapor Kerusakan</h4>
                        <p class="text-xs text-gray-400 font-medium">Bantuan perbaikan</p>
                    </div>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
