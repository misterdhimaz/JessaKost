<x-guest-layout>
    <!-- Header Text -->
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Selamat Datang</h2>
        <p class="text-gray-500 font-medium">Silakan masuk ke akun dasbor Anda.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all duration-300 shadow-sm"
                       placeholder="nama@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-bold text-jessa-maroon hover:text-jessa-maroonDark transition-colors">
                        Lupa password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-jessa-maroon/20 focus:border-jessa-maroon focus:bg-white transition-all duration-300 shadow-sm"
                       placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 text-jessa-maroon bg-gray-50 border-gray-300 rounded focus:ring-jessa-maroon/20 transition-all cursor-pointer">
            <label for="remember_me" class="ml-3 block text-sm font-medium text-gray-600 cursor-pointer">
                Ingat Saya
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center items-center gap-2 py-4 px-4 border border-transparent rounded-2xl shadow-lg text-lg font-bold text-white bg-jessa-maroon hover:bg-jessa-maroonDark focus:outline-none focus:ring-4 focus:ring-jessa-maroon/30 transition-all duration-300 transform hover:-translate-y-1">
                Masuk ke Dasbor <i class="fas fa-arrow-right text-sm"></i>
            </button>
        </div>

        <!-- Contact Admin Link -->
        <div class="text-center mt-8">
            <p class="text-sm text-gray-600 font-medium">
                Belum memiliki akun? <br>
                <span class="text-gray-400 font-normal">Hubungi Admin/Pengelola Kost untuk mendapatkan akses.</span>
            </p>
        </div>
    </form>
</x-guest-layout>
