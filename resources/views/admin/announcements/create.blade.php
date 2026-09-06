<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.announcements.index') }}" class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Buat Pengumuman Baru</h2>
                <p class="text-sm text-gray-400 font-medium">Informasi akan langsung terlihat oleh seluruh anak kost</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-gray-900 text-lg">Form Pengumuman</h3>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block font-bold text-gray-900 text-sm mb-2">Judul Pengumuman</label>
                        <input type="text" name="title" id="title" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors" placeholder="Misal: Info Pemadaman Listrik" required>
                    </div>

                    <div>
                        <label for="priority" class="block font-bold text-gray-900 text-sm mb-2">Tingkat Prioritas</label>
                        <select name="priority" id="priority" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            <option value="normal">Normal (Info Biasa)</option>
                            <option value="important">Perhatian (Penting)</option>
                            <option value="urgent">Mendesak (Darurat)</option>
                        </select>
                    </div>

                    <div>
                        <label for="body" class="block font-bold text-gray-900 text-sm mb-2">Isi Pengumuman</label>
                        <textarea name="body" id="body" rows="6" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors" placeholder="Tuliskan isi pengumuman secara detail di sini..." required></textarea>
                    </div>

                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 text-jessa-maroon bg-gray-50 border-gray-300 rounded focus:ring-jessa-maroon focus:ring-2">
                            <span class="font-bold text-gray-900 text-sm">Aktif & Tampilkan Langsung</span>
                        </label>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                        <a href="{{ route('admin.announcements.index') }}" class="text-gray-500 bg-gray-100 hover:bg-gray-200 font-bold rounded-xl text-sm px-6 py-3 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="text-white bg-jessa-maroon hover:bg-jessa-maroonDark font-bold rounded-xl text-sm px-6 py-3 transition-all shadow-sm hover:shadow-md flex items-center gap-2">
                            <i class="fas fa-paper-plane"></i> Publikasikan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

