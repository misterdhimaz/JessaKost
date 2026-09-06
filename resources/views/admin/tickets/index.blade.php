<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-headset"></i>
            </div>
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                {{ __('Kelola Laporan & Keluhan') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-0">
        <div class="max-w-full">
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-50/50">
                    <div>
                        <h3 class="font-extrabold text-lg text-gray-900">Daftar Laporan Anak Kost</h3>
                        <p class="text-sm text-gray-500 font-medium mt-1">Tindak lanjuti keluhan kerusakan fasilitas atau masalah lainnya.</p>
                    </div>
                </div>

                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                                <th class="p-4">Tanggal</th>
                                <th class="p-4">Pelapor (Kamar)</th>
                                <th class="p-4">Subjek & Deskripsi</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium">
                            @forelse($tickets as $ticket)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="p-4 text-gray-500 whitespace-nowrap">
                                    {{ $ticket->created_at->format('d M Y') }}
                                </td>
                                <td class="p-4">
                                    <p class="font-bold text-gray-900">{{ $ticket->user->name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Kamar {{ $ticket->user->leases->first()->room->room_number ?? '?' }}</p>
                                </td>
                                <td class="p-4 max-w-xs">
                                    <p class="font-bold text-gray-900 truncate">{{ $ticket->subject }}</p>
                                    <p class="text-xs text-gray-500 mt-1 truncate">{{ $ticket->description }}</p>
                                </td>
                                <td class="p-4">
                                    @if($ticket->status == 'open')
                                        <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 px-3 py-1.5 rounded-full text-xs font-bold border border-red-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Baru (Open)
                                        </span>
                                    @elseif($ticket->status == 'in_progress')
                                        <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 px-3 py-1.5 rounded-full text-xs font-bold border border-yellow-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Diproses
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1.5 rounded-full text-xs font-bold border border-green-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    @if($ticket->status != 'resolved')
                                    <button class="inline-flex items-center gap-2 text-jessa-maroon bg-jessa-maroon/5 hover:bg-jessa-maroon hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-colors border border-jessa-maroon/10">
                                        Update Status
                                    </button>
                                    @else
                                    <button class="inline-flex items-center gap-2 text-gray-500 bg-gray-50 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors border border-gray-200">
                                        Lihat Detail
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-gray-500 font-medium">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto mb-3 text-2xl">
                                        <i class="fas fa-check-circle text-green-200"></i>
                                    </div>
                                    <p class="text-gray-900 font-bold text-lg mb-1">Semua Aman!</p>
                                    <p>Tidak ada laporan atau keluhan dari anak kost saat ini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

