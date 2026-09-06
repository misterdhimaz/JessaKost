<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-bed"></i>
            </div>
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                {{ __('Kelola Kamar') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-0">
        <div class="max-w-full">
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-50/50">
                    <div>
                        <h3 class="font-extrabold text-lg text-gray-900">Daftar Kamar</h3>
                        <p class="text-sm text-gray-500 font-medium mt-1">Total {{ $rooms->count() }} kamar terdaftar di sistem.</p>
                    </div>
                    <button class="inline-flex items-center gap-2 bg-jessa-maroon text-white font-bold px-5 py-2.5 rounded-xl hover:bg-jessa-maroonDark transition-colors shadow-sm">
                        <i class="fas fa-plus"></i> Tambah Kamar
                    </button>
                </div>

                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                                <th class="p-4">No. Kamar</th>
                                <th class="p-4">Harga Sewa / Bulan</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium">
                            @forelse($rooms as $room)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-600 font-bold text-lg border border-gray-200">
                                            {{ $room->room_number }}
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-gray-600">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    @if($room->status == 'occupied')
                                        <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1.5 rounded-full text-xs font-bold border border-green-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Terisi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full text-xs font-bold border border-gray-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Kosong
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="w-8 h-8 rounded-lg bg-gray-50 text-gray-500 hover:bg-jessa-maroon hover:text-white flex items-center justify-center transition-colors border border-gray-200" title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button class="w-8 h-8 rounded-lg bg-gray-50 text-gray-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors border border-gray-200" title="Hapus">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500 font-medium">
                                    Belum ada data kamar.
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

