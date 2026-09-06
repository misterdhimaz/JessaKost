<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-book-open"></i>
            </div>
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                {{ __('Buku Tamu & Keamanan') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-0">
        <div class="max-w-full">
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-50/50">
                    <div>
                        <h3 class="font-extrabold text-lg text-gray-900">Catatan Kunjungan Tamu</h3>
                        <p class="text-sm text-gray-500 font-medium mt-1">Pantau siapa saja yang masuk ke area kost.</p>
                    </div>
                    <button class="inline-flex items-center gap-2 bg-jessa-maroon text-white font-bold px-5 py-2.5 rounded-xl hover:bg-jessa-maroonDark transition-colors shadow-sm">
                        <i class="fas fa-user-plus"></i> Catat Tamu Baru
                    </button>
                </div>

                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                                <th class="p-4">Tanggal & Waktu</th>
                                <th class="p-4">Nama Tamu & Tenant</th>
                                <th class="p-4">Status Menginap</th>
                                <th class="p-4 text-center">Foto KTP</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium">
                            @forelse($guests as $guest)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="p-4 text-gray-500">
                                    {{ \Carbon\Carbon::parse($guest->visit_date)->translatedFormat('d M Y') }}
                                </td>
                                <td class="p-4">
                                    <p class="text-gray-900 font-bold">{{ $guest->visitor_name }}</p>
                                    <p class="text-xs text-gray-400 font-medium mt-1">Keperluan: {{ Str::limit($guest->purpose, 30) }}</p>
                                    @if($guest->related_tenant_id)
                                        <p class="text-[10px] bg-jessa-cream/30 text-jessa-maroon px-2 py-0.5 rounded border border-jessa-maroon/20 mt-1 inline-block">
                                            Dilaporkan oleh: {{ \App\Models\User::find($guest->related_tenant_id)->name ?? 'Tenant' }}
                                        </p>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($guest->is_overnight)
                                        <span class="inline-flex items-center gap-1 bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold border border-yellow-100">
                                            <i class="fas fa-moon"></i> Menginap
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-bold border border-blue-100">
                                            <i class="fas fa-sun"></i> Kunjungan
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    @if($guest->id_card_photo_path)
                                        <a href="{{ asset('storage/' . $guest->id_card_photo_path) }}" target="_blank" class="text-jessa-maroon hover:underline font-bold text-xs bg-red-50 px-3 py-1.5 rounded-lg border border-red-100 transition-colors">
                                            <i class="fas fa-id-card"></i> Buka Foto
                                        </a>
                                    @else
                                        <span class="text-gray-300 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500 font-medium flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-3 text-2xl">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    Belum ada catatan tamu.
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

