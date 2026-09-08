<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.rooms.index') }}" class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Tambah Kamar Baru</h2>
                <p class="text-sm text-gray-400 font-medium">Lengkapi detail fasilitas dan harga kamar</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-gray-900 text-lg">Informasi Kamar</h3>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold text-gray-900 text-sm mb-2">Nomor Kamar</label>
                            <input type="text" name="room_number" value="{{ old('room_number') }}" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors" placeholder="Misal: A1, B2" required>
                        </div>
                        
                        <div>
                            <label class="block font-bold text-gray-900 text-sm mb-2">Harga Per Bulan (Rp)</label>
                            <input type="number" name="price_per_month" value="{{ old('price_per_month') }}" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors" placeholder="Misal: 1500000" required>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-900 text-sm mb-2">Status Awal</label>
                        <select name="status" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia (Kosong)</option>
                            <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Terisi (Ada Penghuni)</option>
                            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Sedang Diperbaiki (Maintenance)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-900 text-sm mb-2">Deskripsi & Fasilitas</label>
                        <textarea name="description" rows="5" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors" placeholder="Jelaskan fasilitas kamar (Kamar mandi dalam, AC, Lemari, dll)...">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-50">
                        {{-- Cover Image --}}
                        <div>
                            <label class="block font-bold text-gray-900 text-sm mb-2">Foto Sampul Utama</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition-colors">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-image text-3xl text-gray-400 mb-3"></i>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label class="relative cursor-pointer bg-white rounded-md font-bold text-jessa-maroon hover:text-jessa-maroonDark">
                                            <span>Pilih Foto</span>
                                            <input name="cover_image" type="file" accept="image/*" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">Maks. 5MB</p>
                                </div>
                            </div>
                        </div>

                        {{-- Detail Images --}}
                        <div>
                            <label class="block font-bold text-gray-900 text-sm mb-2">Galeri Foto Tambahan</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition-colors">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-images text-3xl text-gray-400 mb-3"></i>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label class="relative cursor-pointer bg-white rounded-md font-bold text-jessa-maroon hover:text-jessa-maroonDark">
                                            <span>Pilih Banyak Foto sekaligus</span>
                                            <input name="detail_images[]" type="file" accept="image/*" multiple class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">Tahan tombol Ctrl (Windows) untuk memilih >1 foto.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex items-center justify-end gap-3 border-t border-gray-100">
                        <a href="{{ route('admin.rooms.index') }}" class="text-gray-500 bg-gray-100 hover:bg-gray-200 font-bold rounded-xl text-sm px-6 py-3 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="text-white bg-jessa-maroon hover:bg-jessa-maroonDark font-bold rounded-xl text-sm px-6 py-3 transition-all shadow-sm hover:shadow-md flex items-center gap-2">
                            <i class="fas fa-save"></i> Simpan Kamar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
