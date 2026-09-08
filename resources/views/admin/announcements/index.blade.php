<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Pengumuman</h2>
                <p class="text-sm text-gray-400 font-medium">Kelola informasi untuk penghuni kost</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="flex justify-end">
            <a href="{{ route('admin.announcements.create') }}" class="bg-jessa-maroon text-white px-5 py-2.5 rounded-xl font-bold shadow-sm hover:bg-jessa-maroonDark transition-colors flex items-center gap-2">
                <i class="fas fa-plus"></i> Buat Pengumuman
            </a>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-gray-900 text-lg">Daftar Pengumuman</h3>
            </div>

            <div class="p-6 space-y-4">
                @forelse($announcements as $announcement)
                <div class="border border-gray-100 rounded-2xl p-5 hover:border-jessa-maroon/30 hover:bg-jessa-cream/20 transition-all">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div>
                            <h4 class="font-extrabold text-gray-900 text-lg">{{ $announcement->title }}</h4>
                            <p class="text-xs text-gray-400 font-medium mt-1">Dibuat: {{ $announcement->created_at->translatedFormat('d M Y, H:i') }}</p>
                        </div>
                        <div class="flex gap-2">
                            @if($announcement->priority == 'urgent')
                                <span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-xs font-bold border border-red-100">Penting/Mendesak</span>
                            @elseif($announcement->priority == 'important')
                                <span class="bg-yellow-50 text-yellow-600 px-3 py-1 rounded-full text-xs font-bold border border-yellow-100">Perhatian</span>
                            @else
                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold border border-blue-100">Info Biasa</span>
                            @endif

                            @if($announcement->is_active)
                                <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-xs font-bold border border-green-100">Aktif</span>
                            @else
                                <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">Arsip</span>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ Str::limit($announcement->body, 150) }}</p>
                    <div class="pt-4 border-t border-gray-50 flex items-center justify-end gap-2">
                        <a href="{{ route('admin.announcements.edit', $announcement) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-colors" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-xl transition-colors" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-10">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-3xl text-gray-400 mx-auto mb-3">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h4 class="font-extrabold text-gray-900 text-lg mb-1">Belum Ada Pengumuman</h4>
                    <p class="text-gray-500 font-medium text-sm">Buat pengumuman pertama Anda untuk penghuni kost.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

