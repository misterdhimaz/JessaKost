<section>
    <header>
        <h2 class="text-lg font-extrabold text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500 font-medium">
            {{ __("Perbarui foto profil, nama, kontak, dan alamat email Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Profile Photo --}}
        <div class="flex items-center gap-6">
            <div class="shrink-0 w-24 h-24 rounded-full overflow-hidden bg-gray-100 border-4 border-white shadow-sm flex items-center justify-center relative group">
                @if($user->profile_photo_path)
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @else
                    <i class="fas fa-user text-4xl text-gray-300"></i>
                @endif
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <i class="fas fa-camera text-white"></i>
                </div>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-bold text-gray-700 mb-2">Ubah Foto Profil</label>
                <input type="file" name="profile_photo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-jessa-maroon/10 file:text-jessa-maroon hover:file:bg-jessa-maroon/20 cursor-pointer">
                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-bold" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-xl border-gray-200 focus:border-jessa-maroon focus:ring-jessa-maroon" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="email" :value="__('Alamat Email')" class="font-bold" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-xl border-gray-200 focus:border-jessa-maroon focus:ring-jessa-maroon" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Email Anda belum diverifikasi.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('Tautan verifikasi baru telah dikirim ke email Anda.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div>
                <x-input-label for="phone" :value="__('Nomor HP / WhatsApp')" class="font-bold" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full rounded-xl border-gray-200 focus:border-jessa-maroon focus:ring-jessa-maroon" :value="old('phone', $user->phone)" placeholder="08..." />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio / Keterangan')" class="font-bold" />
            <textarea id="bio" name="bio" rows="3" class="mt-1 block w-full rounded-xl border-gray-200 focus:border-jessa-maroon focus:ring-jessa-maroon text-sm" placeholder="Tuliskan sedikit tentang diri Anda (Opsional)...">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="bg-jessa-maroon text-white font-bold py-2 px-6 rounded-xl hover:bg-jessa-maroonDark transition-colors shadow-sm">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600 flex items-center gap-2"
                ><i class="fas fa-check-circle"></i> {{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
