<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">
            Verifikasi Akun Baru
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto space-y-6 mt-10">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-jessa-maroon/10 text-jessa-maroon rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h3 class="font-extrabold text-gray-900 text-xl mb-2">Verifikasi Email OTP</h3>
                <p class="text-gray-500 font-medium text-sm">Kode OTP 6-digit telah dikirimkan ke email <span class="font-bold text-gray-900">{{ $userToVerify->email }}</span>. Masukkan kode tersebut di bawah ini untuk mengaktifkan akun.</p>
            </div>

            <form action="{{ route('owner.users.verify_submit') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $userToVerify->id }}">

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-bold mb-6 text-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl text-sm font-bold mb-6 text-center">
                        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2 text-center">Kode OTP</label>
                    <input type="text" name="otp_code" required maxlength="6" class="w-full text-center text-2xl tracking-[0.5em] font-black rounded-xl border-gray-200 bg-gray-50 p-4 focus:ring-jessa-maroon focus:border-jessa-maroon" placeholder="••••••">
                    @error('otp_code')
                        <p class="text-red-500 text-xs font-bold mt-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-jessa-maroon text-white py-4 rounded-xl font-bold hover:bg-jessa-maroonDark transition-colors shadow-sm">
                    Verifikasi Akun Sekarang
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
