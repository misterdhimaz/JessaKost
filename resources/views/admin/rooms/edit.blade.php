<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.rooms.index') }}" class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-600 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                {{ __('Edit Kamar') }} - {{ $room->room_number }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="room_number" class="block text-sm font-bold text-gray-700 mb-2">Nomor Kamar</label>
                        <input type="text" name="room_number" id="room_number" value="{{ old('room_number', $room->room_number) }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:ring-jessa-maroon focus:border-jessa-maroon transition-colors">
                        @error('room_number') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="price_per_month" class="block text-sm font-bold text-gray-700 mb-2">Harga Sewa / Bulan (Rp)</label>
                        <input type="number" name="price_per_month" id="price_per_month" value="{{ old('price_per_month', $room->price_per_month) }}" required min="0" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:ring-jessa-maroon focus:border-jessa-maroon transition-colors">
                        @error('price_per_month') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-sm font-bold text-gray-700 mb-2">Status Kamar</label>
                    <select name="status" id="status" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:ring-jessa-maroon focus:border-jessa-maroon transition-colors">
                        <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Tersedia (Available)</option>
                        <option value="occupied" {{ old('status', $room->status) == 'occupied' ? 'selected' : '' }}>Terisi (Occupied)</option>
                        <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>Perbaikan (Maintenance)</option>
                    </select>
                    @error('status') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:ring-jessa-maroon focus:border-jessa-maroon transition-colors">{{ old('description', $room->description) }}</textarea>
                    @error('description') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="cover_image" class="block text-sm font-bold text-gray-700 mb-2">Ganti Foto Utama (Cover)</label>
                        <input type="file" name="cover_image" id="cover_image" accept="image/*" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:ring-jessa-maroon focus:border-jessa-maroon transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-jessa-maroon file:text-white hover:file:bg-jessa-maroonDark">
                        <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah foto utama.</p>
                        @error('cover_image') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="detail_images" class="block text-sm font-bold text-gray-700 mb-2">Ganti Foto Detail Baru (Bisa lebih dari satu)</label>
                        <input type="file" name="detail_images[]" id="detail_images" accept="image/*" multiple class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:ring-jessa-maroon focus:border-jessa-maroon transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300">
                        <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah foto detail.</p>
                        @error('detail_images') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('admin.rooms.index') }}" class="px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-3 bg-jessa-maroon text-white font-bold rounded-xl hover:bg-jessa-maroonDark transition-colors shadow-sm">Perbarui Kamar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
