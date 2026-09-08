<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('owner.dashboard') }}" class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600">
                    <i class="fas fa-users-cog text-lg"></i>
                </div>
                <div>
                    <h2 class="font-extrabold text-2xl text-gray-900 leading-tight">Manajemen Pengguna</h2>
                    <p class="text-sm text-gray-500 font-medium mt-1">Daftar Admin & Tenant yang terdaftar di sistem</p>
                </div>
            </div>
            <a href="{{ route('owner.users.create') }}" class="inline-flex items-center justify-center gap-2 bg-jessa-maroon text-white font-bold px-6 py-3 rounded-xl hover:bg-jessa-maroonDark transition-all shadow-sm hover:shadow-md">
                <i class="fas fa-user-plus"></i> Tambah Pengguna
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">

        {{-- Admins Section --}}
        <div>
            <div class="flex items-center gap-2 mb-4 px-2">
                <div class="w-2 h-6 bg-purple-500 rounded-full"></div>
                <h3 class="font-extrabold text-gray-900 text-lg">Staf & Administrator</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($admins as $admin)
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-purple-50 border-2 border-purple-100 shrink-0 flex items-center justify-center font-bold text-purple-600 text-xl">
                        @if($admin->profile_photo_path)
                            <img src="{{ asset('storage/' . $admin->profile_photo_path) }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($admin->name, 0, 2)) }}
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="font-bold text-gray-900 text-lg truncate">{{ $admin->name }}</p>
                        <p class="text-xs text-gray-500 font-medium truncate mb-1">{{ $admin->email }}</p>
                        <span class="inline-flex bg-purple-50 text-purple-600 text-[10px] font-bold px-2 py-0.5 rounded border border-purple-200 uppercase tracking-wider">Admin</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('owner.users.edit', $admin) }}" class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-colors">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('owner.users.destroy', $admin) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus admin ini?');">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white rounded-2xl p-8 border border-gray-100 text-center text-gray-500 font-medium">
                    Belum ada Admin terdaftar.
                </div>
                @endforelse
            </div>
        </div>

        {{-- Tenants Section --}}
        <div>
            <div class="flex items-center gap-2 mb-4 px-2">
                <div class="w-2 h-6 bg-blue-500 rounded-full"></div>
                <h3 class="font-extrabold text-gray-900 text-lg">Penyewa (Tenants)</h3>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-50 bg-gray-50/50">
                                <th class="p-5">Profil Tenant</th>
                                <th class="p-5">Kontak</th>
                                <th class="p-5">No. KTP</th>
                                <th class="p-5 text-right">Tgl Bergabung</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium divide-y divide-gray-50">
                            @forelse($tenants as $tenant)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="p-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center font-bold text-gray-400 shrink-0 border border-gray-200">
                                            @if($tenant->profile_photo_path)
                                                <img src="{{ asset('storage/' . $tenant->profile_photo_path) }}" class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($tenant->name, 0, 2)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $tenant->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $tenant->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-5 text-gray-600">{{ $tenant->phone ?? '-' }}</td>
                                <td class="p-5 text-gray-600">{{ $tenant->ktp_number ?? '-' }}</td>
                                <td class="p-5 text-right text-gray-500">
                                    <div class="flex items-center justify-end gap-2">
                                        <span class="mr-4">{{ $tenant->created_at->translatedFormat('d M Y') }}</span>
                                        <a href="{{ route('owner.users.edit', $tenant) }}" class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('owner.users.destroy', $tenant) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tenant ini?');">
                                            @csrf @method('DELETE')
                                            <button class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-10 text-center text-gray-400 font-medium">Belum ada penyewa (tenant) terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
