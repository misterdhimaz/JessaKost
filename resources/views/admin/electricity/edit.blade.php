<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.electricity.index') }}" class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Edit Tagihan Listrik</h2>
                <p class="text-sm text-gray-400 font-medium">Ubah data tagihan untuk Kamar {{ $bill->lease->room->room_number ?? '?' }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8">
                <form action="{{ route('admin.electricity.update', $bill->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold text-gray-900 text-sm mb-2">Total Tagihan (Rp)</label>
                            <input type="number" name="amount" value="{{ old('amount', $bill->amount) }}" required min="0" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            @error('amount') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block font-bold text-gray-900 text-sm mb-2">Jatuh Tempo</label>
                            <input type="date" name="due_date" value="{{ old('due_date', $bill->due_date) }}" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            @error('due_date') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-900 text-sm mb-2">Status Pembayaran</label>
                        <select name="status" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            <option value="unpaid" {{ old('status', $bill->status) == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                            <option value="paid" {{ old('status', $bill->status) == 'paid' ? 'selected' : '' }}>Lunas</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6 flex items-center justify-end gap-3 border-t border-gray-100">
                        <a href="{{ route('admin.electricity.index') }}" class="text-gray-500 bg-gray-100 hover:bg-gray-200 font-bold rounded-xl text-sm px-6 py-3 transition-colors">Batal</a>
                        <button type="submit" class="text-white bg-jessa-maroon hover:bg-jessa-maroonDark font-bold rounded-xl text-sm px-6 py-3 transition-all shadow-sm">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
