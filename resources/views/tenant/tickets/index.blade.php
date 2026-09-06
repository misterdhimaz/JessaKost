<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tenant.dashboard') }}" class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900">Riwayat Laporan Fasilitas</h2>
                <p class="text-sm text-gray-500 font-medium">Pantau status laporan yang telah Anda kirimkan</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

            {{-- CTA Buat Laporan Baru --}}
            <div class="bg-white rounded-2xl border border-dashed border-jessa-maroon/30 p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center text-orange-500 text-xl shrink-0">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">Ada yang perlu diperbaiki?</p>
                        <p class="text-sm text-gray-500 font-medium">Laporkan fasilitas rusak atau bermasalah kepada kami.</p>
                    </div>
                </div>
                <a href="{{ route('tenant.tickets.create') }}" class="shrink-0 bg-jessa-maroon text-white font-bold px-6 py-3 rounded-xl hover:bg-jessa-maroonDark transition-colors shadow-sm flex items-center gap-2">
                    <i class="fas fa-plus"></i> Buat Laporan Baru
                </a>
            </div>

            {{-- Ticket List --}}
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="font-extrabold text-gray-900">Semua Laporan Saya</h3>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse($tickets as $ticket)
                    <div class="p-5 flex flex-col sm:flex-row sm:items-start justify-between gap-4 hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0 mt-0.5
                                {{ $ticket->status == 'resolved' ? 'bg-green-50 text-green-500' :
                                   ($ticket->status == 'in_progress' ? 'bg-yellow-50 text-yellow-500' : 'bg-red-50 text-red-500') }}">
                                <i class="fas {{ $ticket->status == 'resolved' ? 'fa-check-circle' : ($ticket->status == 'in_progress' ? 'fa-spinner' : 'fa-exclamation-circle') }}"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $ticket->subject }}</p>
                                <p class="text-sm text-gray-500 font-medium mt-1 leading-relaxed max-w-xl">{{ $ticket->description }}</p>
                                <p class="text-xs text-gray-400 font-medium mt-2">
                                    <i class="fas fa-calendar mr-1"></i> Dilaporkan: {{ $ticket->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="sm:flex-shrink-0">
                            @if($ticket->status == 'open')
                                <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 border border-red-100 px-3 py-1.5 rounded-full text-xs font-bold">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span> Menunggu Tindakan
                                </span>
                            @elseif($ticket->status == 'in_progress')
                                <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 border border-yellow-100 px-3 py-1.5 rounded-full text-xs font-bold">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span> Sedang Diproses
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 border border-green-100 px-3 py-1.5 rounded-full text-xs font-bold">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Sudah Selesai
                                </span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="p-16 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-200 mx-auto mb-4 text-3xl">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <p class="font-bold text-gray-900 text-lg mb-1">Belum Ada Laporan</p>
                        <p class="text-gray-400 font-medium text-sm">Anda belum pernah mengirimkan laporan. Semoga semua fasilitas berjalan baik!</p>
                    </div>
                    @endforelse
                </div>
            </div>

    </div>
</x-app-layout>

