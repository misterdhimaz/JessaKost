<x-guest-layout>
    <!-- Header Text -->
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Buat Akun Baru</h2>
        <p class="text-gray-500 font-medium">Bergabunglah dengan komunitas Jessa Kost.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-user text-gray-400"></i>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all duration-300 shadow-sm"
                       placeholder="Nama sesuai KTP">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all duration-300 shadow-sm"
                       placeholder="nama@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all duration-300 shadow-sm"
                           placeholder="••••••••">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-check-circle text-gray-400"></i>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all duration-300 shadow-sm"
                           placeholder="••••••••">
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center items-center gap-2 py-4 px-4 border border-transparent rounded-2xl shadow-lg text-lg font-bold text-white bg-jessa-maroon hover:bg-jessa-maroonDark focus:outline-none focus:ring-4 focus:ring-jessa-maroon/30 transition-all duration-300 transform hover:-translate-y-1">
                Daftar Akun <i class="fas fa-user-plus text-sm"></i>
            </button>
        </div>

        <!-- Login Link -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600 font-medium">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold text-jessa-maroon hover:text-jessa-maroonDark transition-colors">Masuk di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>
