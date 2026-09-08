<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-bolt"></i>
            </div>
            <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
                {{ __('Pencatatan Listrik') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-0">
        <div class="max-w-3xl">
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-extrabold text-lg text-gray-900">Catat Meteran Listrik Bulanan</h3>
                    <p class="text-sm text-gray-500 font-medium mt-1">Sistem akan secara otomatis menghitung selisih dengan bulan sebelumnya dan memasukkannya ke dalam tagihan sewa bulan depan.</p>
                </div>

                <div class="p-8">
                    <form action="{{ route('admin.electricity.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label for="room_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Kamar (Terisi)</label>
                            <select id="room_id" name="room_id" class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all shadow-sm">
                                <option value="">-- Pilih Kamar --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">Kamar {{ $room->room_number }} ({{ $room->leases->where('status', 'active')->first()?->user?->name ?? 'Penghuni' }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="reading_date" class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pencatatan</label>
                                <input type="date" id="reading_date" name="reading_date" value="{{ date('Y-m-d') }}" class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all shadow-sm">
                            </div>

                            <div>
                                <label for="kwh_value" class="block text-sm font-bold text-gray-700 mb-2">Angka Meteran (kWh)</label>
                                <div class="relative">
                                    <input type="number" step="0.01" id="kwh_value" name="kwh_value" placeholder="Contoh: 1450.5" class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all shadow-sm pr-12">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <span class="text-gray-400 font-bold text-sm">kWh</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Foto Meteran (Opsional tapi disarankan)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition-colors cursor-pointer">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-camera text-3xl text-gray-400 mb-3"></i>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-bold text-jessa-maroon hover:text-jessa-maroonDark focus-within:outline-none">
                                            <span>Unggah foto</span>
                                            <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">atau seret dan lepas</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF maksimal 10MB
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 flex justify-end">
                            <button type="submit" class="bg-jessa-maroon hover:bg-jessa-maroonDark text-white font-bold py-3 px-8 rounded-xl shadow-lg transform hover:-translate-y-1 transition-all flex items-center gap-2">
                                <i class="fas fa-save"></i> Simpan Catatan Listrik
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

