<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon border border-jessa-maroon/20">
                    <i class="fas fa-bed text-xl"></i>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                        {{ __('Kelola Kamar') }}
                    </h2>
                    <p class="text-sm text-gray-500 font-medium mt-1">Manajemen unit kamar, harga, dan fasilitas.</p>
                </div>
            </div>
            <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center justify-center gap-2 bg-jessa-maroon text-white font-bold px-6 py-3 rounded-xl hover:bg-jessa-maroonDark transition-all shadow-sm hover:shadow-md">
                <i class="fas fa-plus"></i> Tambah Kamar Baru
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl font-bold flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($rooms as $room)
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden group hover:shadow-md transition-all flex flex-col">
                {{-- Cover Image --}}
                <div class="relative h-48 bg-gray-100 overflow-hidden">
                    @if($room->cover_image_path)
                        <img src="{{ asset('storage/' . $room->cover_image_path) }}" alt="Kamar {{ $room->room_number }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                            <i class="fas fa-image text-4xl mb-2"></i>
                            <span class="text-xs font-bold uppercase tracking-wider">Tanpa Foto</span>
                        </div>
                    @endif
                    
                    {{-- Status Badge (Absolute Top Right) --}}
                    <div class="absolute top-4 right-4">
                        @if($room->status == 'available')
                            <span class="bg-green-500/90 backdrop-blur-md text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">
                                <i class="fas fa-check-circle mr-1"></i> Tersedia
                            </span>
                        @elseif($room->status == 'occupied')
                            <span class="bg-blue-500/90 backdrop-blur-md text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">
                                <i class="fas fa-user mr-1"></i> Terisi
                            </span>
                        @else
                            <span class="bg-red-500/90 backdrop-blur-md text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">
                                <i class="fas fa-tools mr-1"></i> Perbaikan
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-extrabold text-2xl text-gray-900">Kamar {{ $room->room_number }}</h3>
                        <div class="text-right">
                            <p class="text-jessa-maroon font-extrabold text-lg">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">/ Bulan</p>
                        </div>
                    </div>
                    
                    <p class="text-sm text-gray-500 font-medium mb-6 line-clamp-2 flex-1">
                        {{ $room->description ?: 'Belum ada deskripsi untuk kamar ini.' }}
                    </p>

                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between mt-auto">
                        <div class="flex gap-2">
                            <div class="flex -space-x-2">
                                @if(is_array($room->detail_image_paths) && count($room->detail_image_paths) > 0)
                                    @foreach(array_slice($room->detail_image_paths, 0, 3) as $detailPic)
                                        <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-200 overflow-hidden">
                                            <img src="{{ asset('storage/' . $detailPic) }}" class="w-full h-full object-cover">
                                        </div>
                                    @endforeach
                                    @if(count($room->detail_image_paths) > 3)
                                        <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-500">
                                            +{{ count($room->detail_image_paths) - 3 }}
                                        </div>
                                    @endif
                                @else
                                    <span class="text-xs text-gray-400 font-medium italic">0 Foto Galeri</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.rooms.edit', $room) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-colors" title="Edit Kamar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-xl transition-colors" title="Hapus Kamar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-white rounded-3xl shadow-sm border border-gray-100 p-12 text-center flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-4 text-4xl border border-gray-100">
                    <i class="fas fa-bed"></i>
                </div>
                <h3 class="font-extrabold text-gray-900 text-xl mb-1">Belum Ada Kamar</h3>
                <p class="text-gray-500 font-medium mb-6">Tambahkan unit kamar pertama Anda untuk mulai mengelola kost.</p>
                <a href="{{ route('admin.rooms.create') }}" class="bg-jessa-maroon text-white font-bold px-6 py-3 rounded-xl hover:bg-jessa-maroonDark transition-colors">
                    <i class="fas fa-plus mr-2"></i> Tambah Kamar Baru
                </a>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
