<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('owner.users.index') }}" class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Edit Pengguna</h2>
                <p class="text-sm text-gray-400 font-medium">Ubah detail atau peran (role) akun ini</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8">
                <form action="{{ route('owner.users.update', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-bold text-gray-900 text-sm mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                        @error('name') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold text-gray-900 text-sm mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            @error('email') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block font-bold text-gray-900 text-sm mb-2">Nomor HP / WA</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                            @error('phone') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold text-gray-900 text-sm mb-2">Peran (Role)</label>
                            <select name="role" required class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors">
                                <option value="tenant" {{ old('role', $user->role) == 'tenant' ? 'selected' : '' }}>Penyewa (Tenant)</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin / Staf</option>
                            </select>
                            @error('role') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block font-bold text-gray-900 text-sm mb-2">Ubah Password</label>
                            <input type="password" name="password" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors" placeholder="Kosongkan jika tidak ingin mengubah">
                            @error('password') <span class="text-red-500 text-xs font-bold mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-6 flex items-center justify-end gap-3 border-t border-gray-100">
                        <a href="{{ route('owner.users.index') }}" class="text-gray-500 bg-gray-100 hover:bg-gray-200 font-bold rounded-xl text-sm px-6 py-3 transition-colors">Batal</a>
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-bold rounded-xl text-sm px-6 py-3 transition-all shadow-sm">Perbarui Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
