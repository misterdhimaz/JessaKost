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

        {{-- Hero Banner --}}
        <div class="relative bg-gradient-to-r from-jessa-maroonDark via-jessa-maroon to-red-600 rounded-[2.5rem] p-8 md:p-12 overflow-hidden shadow-2xl shadow-jessa-maroon/20 group">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full filter blur-3xl transform translate-x-1/2 -translate-y-1/2 group-hover:scale-150 transition-transform duration-1000"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-jessa-cream opacity-20 rounded-full filter blur-2xl transform -translate-x-1/2 translate-y-1/2 group-hover:scale-150 transition-transform duration-1000"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <span class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/20 text-white/90 text-xs font-bold uppercase tracking-widest mb-4 backdrop-blur-sm shadow-sm">
                        <i class="fas fa-home text-green-300 mr-1"></i> Portal Penghuni
                    </span>
                    <h2 class="text-3xl md:text-5xl font-black text-white mb-2 tracking-tight">Halo, {{ explode(' ', Auth::user()->name)[0] }}! <span class="animate-wave inline-block origin-bottom-right">👋</span></h2>
                    <p class="text-white/80 font-medium text-sm md:text-base max-w-xl">Selamat datang di beranda personal Anda. Pantau tagihan dan info kost dari sini.</p>
                </div>

                @if($lease)
                <div class="hidden md:flex gap-3">
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 text-center text-white min-w-[120px] flex flex-col items-center justify-center">
                        <p class="text-3xl font-black">{{ $lease->room->room_number }}</p>
                        <p class="text-[10px] uppercase tracking-wider opacity-80 font-bold mt-1">Kamar Anda</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if(!$lease)
        <div class="bg-white rounded-3xl border border-yellow-100 p-8 flex items-center gap-6 shadow-sm">
            <div class="w-16 h-16 bg-yellow-50 rounded-2xl flex items-center justify-center text-yellow-500 text-2xl shrink-0">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div>
                <h3 class="font-extrabold text-gray-900 text-xl mb-1">Kamar Belum Ditetapkan</h3>
                <p class="text-gray-500 font-medium">Anda belum memiliki kontrak sewa aktif. Hubungi Admin atau Pemilik kost untuk informasi lebih lanjut.</p>
            </div>
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Bagian Kiri: Info Utama --}}
            <div class="lg:col-span-2 space-y-8">
                
                <h3 class="font-extrabold text-lg text-gray-900 flex items-center"><i class="fas fa-wallet text-jessa-maroon mr-2"></i>Status Keuangan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-center gap-4 mb-4 relative z-10">
                            <div class="w-12 h-12 bg-green-50 text-green-500 rounded-xl flex items-center justify-center text-xl">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Sudah Lunas</p>
                                <p class="text-2xl font-black text-gray-900">{{ $paidBillsCount }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-center gap-4 mb-4 relative z-10">
                            <div class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center text-xl">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Belum Dibayar</p>
                                <p class="text-2xl font-black text-gray-900">{{ $unpaidBillsCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-2">
                    <h3 class="font-extrabold text-lg text-gray-900"><i class="fas fa-file-invoice-dollar text-jessa-maroon mr-2"></i>Tagihan Terbaru</h3>
                    <a href="{{ route('tenant.bills.index') }}" class="text-sm font-bold text-jessa-maroon hover:text-jessa-maroonDark flex items-center gap-1 group">
                        Lihat Semua <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                    <div class="divide-y divide-gray-50">
                        @forelse($recentBills as $bill)
                        <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-gray-50/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl shrink-0 bg-{{ $bill->type_color }}/10 text-{{ $bill->type_color }}">
                                    <i class="fas {{ $bill->type_icon }}"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">Tagihan {{ $bill->type_label }}</p>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5"><i class="far fa-calendar-alt mr-1"></i>Periode: {{ $bill->billing_period ?? \Carbon\Carbon::parse($bill->due_date)->translatedFormat('F Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 sm:flex-shrink-0">
                                <p class="font-black text-gray-900">Rp {{ number_format($bill->amount, 0, ',', '.') }}</p>
                                @if($bill->status == 'unpaid')
                                    <a href="{{ route('tenant.bills.pay', $bill->id) }}" class="bg-jessa-maroon text-white font-bold px-5 py-2 rounded-xl hover:bg-jessa-maroonDark transition-all text-sm shadow-sm hover:scale-105">
                                        Bayar
                                    </a>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 border border-green-100 px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">
                                        <i class="fas fa-check-circle"></i> Lunas
                                    </span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="p-10 text-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-3xl text-gray-300 mx-auto mb-3">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                            <h4 class="font-extrabold text-gray-900 text-lg mb-1">Tidak Ada Tagihan!</h4>
                            <p class="text-gray-500 font-medium text-sm">Semua tagihan Anda telah lunas.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="font-extrabold text-lg text-gray-900 mb-4"><i class="fas fa-bolt text-jessa-maroon mr-2"></i>Akses Cepat</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('tenant.profile.edit') }}" class="flex items-center gap-4 p-4 rounded-3xl bg-white border border-gray-100 shadow-sm hover:border-jessa-maroon/30 hover:shadow-md transition-all group">
                            <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-500 group-hover:bg-jessa-maroon group-hover:text-white transition-colors shrink-0">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-gray-900 text-sm">Pengaturan Profil</h4>
                                <p class="text-xs text-gray-400 font-medium">Ubah data identitas</p>
                            </div>
                        </a>

                        <a href="{{ route('tenant.guests.create') }}" class="flex items-center gap-4 p-4 rounded-3xl bg-white border border-gray-100 shadow-sm hover:border-blue-500/30 hover:shadow-md transition-all group">
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors shrink-0">
                                <i class="fas fa-address-book"></i>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-gray-900 text-sm">Lapor Tamu</h4>
                                <p class="text-xs text-gray-400 font-medium">Buku tamu & izin menginap</p>
                            </div>
                        </a>

                        <a href="{{ route('tenant.announcements.index') }}" class="flex items-center gap-4 p-4 rounded-3xl bg-white border border-gray-100 shadow-sm hover:border-yellow-500/30 hover:shadow-md transition-all group">
                            <div class="w-12 h-12 bg-yellow-50 rounded-2xl flex items-center justify-center text-yellow-500 group-hover:bg-yellow-500 group-hover:text-white transition-colors shrink-0">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-gray-900 text-sm">Pengumuman</h4>
                                <p class="text-xs text-gray-400 font-medium">Info penting dari kost</p>
                            </div>
                        </a>

                        <a href="{{ route('tenant.tickets.create') }}" class="flex items-center gap-4 p-4 rounded-3xl bg-white border border-gray-100 shadow-sm hover:border-red-500/30 hover:shadow-md transition-all group">
                            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-colors shrink-0">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-gray-900 text-sm">Lapor Kerusakan</h4>
                                <p class="text-xs text-gray-400 font-medium">Bantuan teknisi kost</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Bagian Kanan: Info Kost & Sidebar --}}
            <div class="space-y-6">
                <h3 class="font-extrabold text-lg text-gray-900"><i class="fas fa-star text-yellow-400 mr-2"></i>Fasilitas & Kontak</h3>

                @foreach($wifiNetworks as $wifi)
                <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-[2rem] p-6 shadow-lg shadow-purple-500/20 text-white relative overflow-hidden group">
                    <!-- dekorasi -->
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full filter blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    
                    <div class="relative z-10 flex items-center gap-3 mb-4 border-b border-white/20 pb-4">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white shadow-inner">
                            <i class="fas fa-wifi text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-white/70 font-bold uppercase tracking-wider">Jaringan WiFi</p>
                            <p class="font-black text-lg">{{ $wifi->name }}</p>
                        </div>
                    </div>

                    <div class="relative z-10 space-y-3">
                        <div class="bg-black/20 rounded-xl p-3 backdrop-blur-sm border border-white/10">
                            <p class="text-[10px] text-white/50 uppercase font-bold tracking-widest mb-1">SSID Name</p>
                            <p class="font-extrabold font-mono text-sm break-words">{{ $wifi->ssid }}</p>
                        </div>
                        <div class="bg-black/20 rounded-xl p-3 backdrop-blur-sm border border-white/10">
                            <p class="text-[10px] text-white/50 uppercase font-bold tracking-widest mb-1">Password</p>
                            <div class="flex items-center justify-between">
                                <p class="font-extrabold font-mono text-sm break-words">{{ $wifi->password }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="bg-white rounded-[2rem] border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden text-center mt-6">
                    <div class="w-14 h-14 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-3">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h4 class="font-extrabold text-gray-900 mb-1">Kontak Pengelola</h4>
                    <p class="text-sm text-gray-500 mb-4">Butuh bantuan mendesak atau pertanyaan seputar kost?</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="block w-full bg-green-500 text-white font-bold py-3.5 px-4 rounded-xl hover:bg-green-600 transition-colors shadow-sm hover:shadow-lg hover:shadow-green-500/30">
                        Chat WhatsApp
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
