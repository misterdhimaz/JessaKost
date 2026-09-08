<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Buat Keluhan / Laporan</h2>
                <p class="text-sm text-gray-400 font-medium">Sampaikan keluhan atau masalah sarpras di kamar Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        <form method="POST" action="{{ route('tenant.tickets.store') }}" enctype="multipart/form-data" class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
            @csrf

            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <x-input-label for="title" value="Judul Keluhan" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus placeholder="Contoh: AC Bocor / Lampu Kamar Mandi Mati" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="description" value="Deskripsi Detail" />
                    <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-jessa-maroon focus:ring-jessa-maroon rounded-xl shadow-sm" required placeholder="Jelaskan secara detail masalah yang Anda alami..."></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Image Proof -->
                <div>
                    <x-input-label for="image" value="Foto Bukti (Opsional)" />
                    <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-jessa-maroon/10 file:text-jessa-maroon hover:file:bg-jessa-maroon/20 transition-all cursor-pointer border border-gray-200 rounded-xl p-2">
                    <p class="text-xs text-gray-400 mt-2"><i class="fas fa-info-circle mr-1"></i>Maksimal 2MB, format JPG/PNG</p>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('tenant.tickets.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-colors">Batal</a>
                <button type="submit" class="px-6 py-3 bg-jessa-maroon hover:bg-jessa-maroonDark text-white font-bold rounded-xl shadow-sm transition-colors flex items-center gap-2">
                    <i class="fas fa-paper-plane"></i> Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
