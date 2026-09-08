<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Terima kasih telah mendaftar! Silakan masukkan 6 digit kode OTP yang telah dikirim ke email Anda untuk mengaktifkan akun.') }}
        <br><br>
        <strong class="text-jessa-maroon">Perhatian (Mode Pengembangan):</strong> Silakan cek file <code>storage/logs/laravel.log</code> untuk melihat kode OTP Anda jika email belum di-setting.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('success')" />

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

        <!-- OTP Code -->
        <div>
            <x-input-label for="otp_code" value="{{ __('Kode OTP 6-Digit') }}" />

            <x-text-input id="otp_code" class="block mt-1 w-full tracking-[1em] text-center font-bold text-2xl py-3"
                            type="text"
                            name="otp_code"
                            required
                            autofocus
                            maxlength="6"
                            placeholder="••••••" />

            <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="w-full justify-center py-3">
                {{ __('Verifikasi Akun') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

