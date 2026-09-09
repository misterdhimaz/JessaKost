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

    <div class="space-y-0" x-data="{ showModal: false, ticketId: null, ticketStatus: '', ticketCost: '' }">
        <div class="max-w-full">
            <!-- Filter Bar -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6 flex flex-wrap gap-4 items-center justify-between">
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <form action="{{ route('admin.tickets.index') }}" method="GET" class="flex flex-wrap gap-3 w-full md:w-auto" id="filterForm">
                        <select name="status" class="border-gray-200 rounded-xl text-sm focus:ring-jessa-maroon focus:border-jessa-maroon" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending (Baru)</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Diproses</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <select name="category" class="border-gray-200 rounded-xl text-sm focus:ring-jessa-maroon focus:border-jessa-maroon" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Semua Kategori</option>
                            <option value="kerusakan" {{ request('category') == 'kerusakan' ? 'selected' : '' }}>Kerusakan</option>
                            <option value="keluhan" {{ request('category') == 'keluhan' ? 'selected' : '' }}>Keluhan</option>
                            <option value="layanan" {{ request('category') == 'layanan' ? 'selected' : '' }}>Layanan</option>
                            <option value="lainnya" {{ request('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @if(request('status') || request('category'))
                            <a href="{{ route('admin.tickets.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-200">Reset</a>
                        @endif
                    </form>
                </div>
            </div>

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
                                <th class="p-4">Status & Biaya</th>
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
                                    <p class="text-xs text-gray-500 mt-1">Kamar {{ $ticket->room->room_number ?? '?' }}</p>
                                </td>
                                <td class="p-4 max-w-xs">
                                    <p class="font-bold text-gray-900 truncate">{{ $ticket->title }}</p>
                                    <span class="inline-block mt-1 px-2 py-0.5 bg-gray-100 text-gray-600 rounded-md text-[10px] font-bold uppercase">{{ $ticket->category ?? 'Lainnya' }}</span>
                                    <p class="text-xs text-gray-500 mt-1 truncate">{{ $ticket->description }}</p>
                                    @if($ticket->image_path)
                                        <a href="{{ asset('storage/' . $ticket->image_path) }}" target="_blank" class="text-xs text-blue-500 hover:underline mt-1 inline-block"><i class="fas fa-image mr-1"></i>Lihat Foto</a>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($ticket->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 px-3 py-1.5 rounded-full text-xs font-bold border border-red-100 mb-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Baru (Pending)
                                        </span>
                                    @elseif($ticket->status == 'in_progress')
                                        <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 px-3 py-1.5 rounded-full text-xs font-bold border border-yellow-100 mb-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Diproses
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1.5 rounded-full text-xs font-bold border border-green-100 mb-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai
                                        </span>
                                    @endif

                                    @if($ticket->cost)
                                        <p class="text-xs text-gray-600 font-bold mt-1">Biaya: Rp{{ number_format($ticket->cost, 0, ',', '.') }}</p>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    <button @click="showModal = true; ticketId = '{{ $ticket->id }}'; ticketStatus = '{{ $ticket->status }}'; ticketCost = '{{ $ticket->cost ?? '' }}';" class="inline-flex items-center gap-2 text-jessa-maroon bg-jessa-maroon/5 hover:bg-jessa-maroon hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-colors border border-jessa-maroon/10">
                                        Update
                                    </button>
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

        <!-- Modal Update Status -->
        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div x-show="showModal" class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" @click="showModal = false"></div>

                <div x-show="showModal" class="relative inline-block w-full max-w-md p-8 overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl rounded-[2rem] sm:my-8 sm:align-middle">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-extrabold text-gray-900">Update Status Laporan</h3>
                        <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-500 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <form :action="'/admin/tickets/' + ticketId" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <div>
                            <x-input-label for="status" value="Status Pengerjaan" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-jessa-maroon focus:ring-jessa-maroon rounded-xl shadow-sm" x-model="ticketStatus" required>
                                <option value="pending">Menunggu Tindakan (Pending)</option>
                                <option value="in_progress">Sedang Diproses (In Progress)</option>
                                <option value="resolved">Sudah Selesai (Resolved)</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="cost" value="Biaya Perbaikan (Rp) - Opsional" />
                            <x-text-input id="cost" name="cost" type="number" class="mt-1 block w-full" x-model="ticketCost" placeholder="Contoh: 150000" />
                            <p class="text-xs text-gray-400 mt-1">Hanya diisi jika ada biaya perbaikan yang dibebankan/dikeluarkan.</p>
                        </div>

                        <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="showModal = false" class="px-5 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl font-bold transition-colors">Batal</button>
                            <button type="submit" class="px-5 py-2.5 text-white bg-jessa-maroon hover:bg-jessa-maroonDark rounded-xl font-bold shadow-sm transition-colors">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

