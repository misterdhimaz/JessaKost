<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-user-edit"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Pengaturan Profil</h2>
                <p class="text-sm text-gray-400 font-medium">Lengkapi identitas diri Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl space-y-6">

        @if(session('success'))
            <div class="p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl font-bold flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-gray-900 text-lg">Informasi Pribadi</h3>
            </div>

            <form action="{{ route('tenant.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')

                <div class="flex flex-col md:flex-row gap-8">
                    {{-- Foto Profil --}}
                    <div class="w-full md:w-1/3 flex flex-col items-center">
                        <div class="w-32 h-32 rounded-full bg-gray-100 border-4 border-white shadow-md overflow-hidden mb-4 relative group">
                            @if($profile->profile_photo_path)
                                <img src="{{ asset('storage/' . $profile->profile_photo_path) }}" alt="Foto Profil" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-4xl">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer" onclick="document.getElementById('profile_photo').click()">
                                <i class="fas fa-camera text-white text-xl"></i>
                            </div>
                        </div>
                        <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*" capture="user">
                        <p class="text-xs text-gray-400 font-medium text-center">Klik foto untuk mengubah.<br>Format: JPG/PNG, Maks: 2MB.</p>
                    </div>

                    {{-- Form Fields --}}
                    <div class="w-full md:w-2/3 space-y-5">

                        <div>
                            <label for="name" class="block font-bold text-gray-900 text-sm mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="nim" class="block font-bold text-gray-900 text-sm mb-2">NIM / NIK</label>
                                <input type="text" name="nim" id="nim" value="{{ old('nim', $profile->nim) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            </div>
                            <div>
                                <label for="campus" class="block font-bold text-gray-900 text-sm mb-2">Kampus / Instansi</label>
                                <input type="text" name="campus" id="campus" value="{{ old('campus', $profile->campus) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            </div>
                        </div>

                        <div>
                            <label for="origin_address" class="block font-bold text-gray-900 text-sm mb-2">Alamat Asal</label>
                            <textarea name="origin_address" id="origin_address" rows="3" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">{{ old('origin_address', $profile->origin_address) }}</textarea>
                        </div>

                        <hr class="border-gray-100 my-6">
                        <h4 class="font-extrabold text-gray-900 mb-4"><i class="fas fa-users text-jessa-maroon mr-2"></i>Informasi Orang Tua / Wali</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="parent_name" class="block font-bold text-gray-900 text-sm mb-2">Nama Orang Tua</label>
                                <input type="text" name="parent_name" id="parent_name" value="{{ old('parent_name', $profile->parent_name) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            </div>
                            <div>
                                <label for="parent_phone" class="block font-bold text-gray-900 text-sm mb-2">No. HP Orang Tua (Darurat)</label>
                                <input type="text" name="parent_phone" id="parent_phone" value="{{ old('parent_phone', $profile->parent_phone) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            </div>
                        </div>

                        <div class="pt-6 text-right">
                            <button type="submit" class="bg-jessa-maroon text-white font-bold px-8 py-3 rounded-xl hover:bg-jessa-maroonDark transition-all shadow-sm">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>

