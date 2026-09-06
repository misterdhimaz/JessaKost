<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tenant.tickets.index') }}" class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center text-orange-500">
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900">Laporan Fasilitas Baru</h2>
                <p class="text-sm text-gray-500 font-medium">Kami akan menindaklanjuti laporan Anda secepatnya</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">

            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="h-2 bg-gradient-to-r from-jessa-maroon to-orange-400"></div>

                <div class="p-8">
                    <form action="#" method="POST" class="space-y-6">
                        @csrf

                        {{-- Category --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Kategori Masalah</label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                @foreach([
                                    ['icon' => 'fa-bolt', 'label' => 'Listrik', 'val' => 'electricity', 'color' => 'yellow'],
                                    ['icon' => 'fa-tint', 'label' => 'Air', 'val' => 'water', 'color' => 'blue'],
                                    ['icon' => 'fa-wifi', 'label' => 'Internet', 'val' => 'internet', 'color' => 'purple'],
                                    ['icon' => 'fa-broom', 'label' => 'Kebersihan', 'val' => 'hygiene', 'color' => 'green'],
                                ] as $cat)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="category" value="{{ $cat['val'] }}" class="sr-only peer">
                                    <div class="flex flex-col items-center gap-2 p-4 rounded-2xl border-2 border-gray-100 bg-gray-50 transition-all peer-checked:border-jessa-maroon peer-checked:bg-jessa-cream/40 peer-checked:text-jessa-maroon hover:border-gray-200">
                                        <i class="fas {{ $cat['icon'] }} text-xl text-gray-400 peer-checked:text-jessa-maroon"></i>
                                        <span class="text-xs font-bold text-gray-600">{{ $cat['label'] }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label for="subject" class="block text-sm font-bold text-gray-700 mb-2">Judul Laporan</label>
                            <input type="text" id="subject" name="subject" required
                                   class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all shadow-sm"
                                   placeholder="Contoh: Lampu kamar mati total">
                        </div>

                        {{-- Description --}}
                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Detail</label>
                            <textarea id="description" name="description" rows="5" required
                                      class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all shadow-sm resize-none"
                                      placeholder="Jelaskan masalah yang Anda hadapi secara detail, termasuk kapan mulai terjadi dan seberapa parah..."></textarea>
                        </div>

                        {{-- Photo --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Foto Pendukung <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-200 rounded-xl hover:border-jessa-maroon/40 hover:bg-jessa-cream/20 transition-all cursor-pointer">
                                <div class="space-y-2 text-center">
                                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 mx-auto text-xl">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                    <div class="flex text-sm text-gray-500 justify-center">
                                        <label for="photo" class="cursor-pointer font-bold text-jessa-maroon hover:underline">
                                            Pilih foto
                                            <input id="photo" name="photo" type="file" accept="image/*" class="sr-only">
                                        </label>
                                        <p class="pl-1">atau seret ke sini</p>
                                    </div>
                                    <p class="text-xs text-gray-400">JPG, PNG maksimal 5MB</p>
                                </div>
                            </div>
                        </div>

                        {{-- Info Box --}}
                        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex items-start gap-3">
                            <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 shrink-0 mt-0.5">
                                <i class="fas fa-info text-xs"></i>
                            </div>
                            <p class="text-sm text-blue-700 font-medium leading-relaxed">
                                Laporan Anda akan langsung diterima oleh Admin dan akan direspon dalam waktu <strong>1×24 jam</strong>. Anda dapat memantau statusnya di halaman Riwayat Laporan.
                            </p>
                        </div>

                        {{-- Submit --}}
                        <div class="pt-2 flex gap-4">
                            <a href="{{ route('tenant.tickets.index') }}" class="flex-1 text-center py-3 px-6 border-2 border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="flex-1 flex items-center justify-center gap-2 py-3 px-6 bg-jessa-maroon text-white font-bold rounded-xl hover:bg-jessa-maroonDark transition-colors shadow-lg hover:-translate-y-0.5 transform">
                                <i class="fas fa-paper-plane"></i> Kirim Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

    </div>
</x-app-layout>
