<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-wifi"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Manajemen WiFi</h2>
                <p class="text-sm text-gray-400 font-medium">Kelola jaringan WiFi untuk penghuni kost</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6" x-data="{ showModal: false, editMode: false, modalData: { id: null, name: '', ssid: '', password: '' } }">
        <div class="flex justify-end">
            <button @click="showModal = true; editMode = false; modalData = { id: null, name: '', ssid: '', password: '' }" class="bg-jessa-maroon text-white px-5 py-2.5 rounded-xl font-bold shadow-sm hover:bg-jessa-maroonDark transition-colors flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah WiFi
            </button>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-gray-900 text-lg">Daftar Jaringan WiFi</h3>
            </div>

            <div class="p-6 space-y-4">
                @forelse($wifiNetworks as $wifi)
                <div class="border border-gray-100 rounded-2xl p-5 hover:border-jessa-maroon/30 hover:bg-jessa-cream/20 transition-all flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
                    <div>
                        <h4 class="font-extrabold text-gray-900 text-lg flex items-center gap-2">
                            <i class="fas fa-wifi text-jessa-maroon"></i> {{ $wifi->name }}
                        </h4>
                        <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">SSID</p>
                                <p class="font-bold text-gray-800">{{ $wifi->ssid }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Password</p>
                                <p class="font-mono text-gray-600">{{ $wifi->password }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 w-full md:w-auto justify-end mt-4 md:mt-0 pt-4 md:pt-0 border-t md:border-t-0 border-gray-50">
                        <button @click="showModal = true; editMode = true; modalData = { id: '{{ $wifi->id }}', name: '{{ $wifi->name }}', ssid: '{{ $wifi->ssid }}', password: '{{ $wifi->password }}' }" class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-colors" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('admin.wifi.destroy', $wifi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jaringan WiFi ini?');" class="inline-block">
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
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h4 class="font-extrabold text-gray-900 text-lg mb-1">Belum Ada WiFi</h4>
                    <p class="text-gray-500 font-medium text-sm">Tambahkan jaringan WiFi pertama Anda untuk penghuni kost.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Modal Form -->
        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" @click="showModal = false" aria-hidden="true"></div>

                <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative inline-block w-full max-w-md p-8 overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl rounded-[2rem] sm:my-8 sm:align-middle">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-extrabold text-gray-900" x-text="editMode ? 'Edit WiFi' : 'Tambah WiFi Baru'"></h3>
                        <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-500 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <form :action="editMode ? '{{ url('admin/wifi') }}/' + modalData.id : '{{ route('admin.wifi.store') }}'" method="POST" class="space-y-5">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div>
                            <x-input-label for="name" value="Nama Jaringan (Label)" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" x-model="modalData.name" required placeholder="Contoh: WiFi Lantai 1" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="ssid" value="SSID (Nama WiFi)" />
                            <x-text-input id="ssid" name="ssid" type="text" class="mt-1 block w-full" x-model="modalData.ssid" required placeholder="Contoh: JessaKost_1" />
                            <x-input-error :messages="$errors->get('ssid')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" value="Password WiFi" />
                            <x-text-input id="password" name="password" type="text" class="mt-1 block w-full" x-model="modalData.password" required placeholder="Contoh: jessa2024" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="showModal = false" class="px-5 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl font-bold transition-colors">Batal</button>
                            <button type="submit" class="px-5 py-2.5 text-white bg-jessa-maroon hover:bg-jessa-maroonDark rounded-xl font-bold shadow-sm transition-colors" x-text="editMode ? 'Simpan Perubahan' : 'Tambah WiFi'"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

