<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Laporan Pengeluaran</h2>
                <p class="text-sm text-gray-400 font-medium">Pantau dan catat uang keluar untuk operasional kost</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6" x-data="{ showModal: false }">
        <!-- Summary Cards & Action -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-4 w-full md:w-auto">
                <div class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Total Pengeluaran Bulan Ini</p>
                    <p class="text-2xl font-black text-gray-900">Rp{{ number_format($expenses->where('expense_date', '>=', now()->startOfMonth())->sum('amount'), 0, ',', '.') }}</p>
                </div>
            </div>

            <button @click="showModal = true" class="w-full md:w-auto bg-jessa-maroon text-white px-5 py-3 rounded-xl font-bold shadow-sm hover:bg-jessa-maroonDark transition-colors flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Pengeluaran
            </button>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-gray-900 text-lg">Daftar Pengeluaran Keseluruhan</h3>
            </div>

            <div class="overflow-x-auto p-4">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Kategori & Judul</th>
                            <th class="p-4">Pencatat</th>
                            <th class="p-4 text-right">Nominal (Rp)</th>
                            <th class="p-4 text-center">Bukti Nota</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium">
                        @forelse($expenses as $expense)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="p-4 text-gray-500 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                            </td>
                            <td class="p-4">
                                <p class="font-bold text-gray-900">{{ $expense->title }}</p>
                                <span class="inline-block mt-1 px-2 py-1 bg-gray-100 text-gray-600 rounded-md text-[10px] font-bold uppercase">{{ $expense->category }}</span>
                                @if($expense->notes)
                                    <p class="text-xs text-gray-500 mt-1 truncate max-w-[200px]">{{ $expense->notes }}</p>
                                @endif
                            </td>
                            <td class="p-4 text-gray-600">
                                <i class="fas fa-user-circle mr-1"></i> {{ $expense->user->name }}
                            </td>
                            <td class="p-4 text-right">
                                <p class="font-extrabold text-jessa-maroon">Rp{{ number_format($expense->amount, 0, ',', '.') }}</p>
                            </td>
                            <td class="p-4 text-center">
                                @if($expense->proof_image_path)
                                    <a href="{{ asset('storage/' . $expense->proof_image_path) }}" target="_blank" class="text-blue-500 hover:text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg transition-colors inline-block" title="Lihat Bukti Nota">
                                        <i class="fas fa-receipt"></i>
                                    </a>
                                @else
                                    <span class="text-gray-300"><i class="fas fa-times-circle"></i></span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-500 font-medium">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto mb-3 text-2xl">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <p class="text-gray-900 font-bold text-lg mb-1">Belum Ada Pengeluaran</p>
                                <p>Belum ada catatan pengeluaran yang dibuat oleh Admin/Owner.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah Pengeluaran -->
        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div x-show="showModal" class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" @click="showModal = false"></div>

                <div x-show="showModal" class="relative inline-block w-full max-w-md p-8 overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl rounded-[2rem] sm:my-8 sm:align-middle">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-extrabold text-gray-900">Catat Pengeluaran Baru</h3>
                        <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-500 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <form action="{{ route('owner.expenses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="title" value="Judul / Nama Barang" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required placeholder="Contoh: Beli Token Listrik Utama" />
                        </div>

                        <div>
                            <x-input-label for="amount" value="Nominal (Rp)" />
                            <x-text-input id="amount" name="amount" type="number" class="mt-1 block w-full" required placeholder="Contoh: 150000" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="expense_date" value="Tanggal" />
                                <x-text-input id="expense_date" name="expense_date" type="date" class="mt-1 block w-full" required value="{{ date('Y-m-d') }}" />
                            </div>
                            <div>
                                <x-input-label for="category" value="Kategori" />
                                <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-jessa-maroon focus:ring-jessa-maroon rounded-xl shadow-sm" required>
                                    <option value="operational">Operasional</option>
                                    <option value="maintenance">Perbaikan/Maintenance</option>
                                    <option value="salary">Gaji Staf</option>
                                    <option value="other">Lain-lain</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="notes" value="Keterangan (Opsional)" />
                            <textarea id="notes" name="notes" rows="2" class="mt-1 block w-full border-gray-300 focus:border-jessa-maroon focus:ring-jessa-maroon rounded-xl shadow-sm"></textarea>
                        </div>

                        <div>
                            <x-input-label for="proof_image" value="Upload Foto Nota (Opsional)" />
                            <input type="file" id="proof_image" name="proof_image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-jessa-maroon/10 file:text-jessa-maroon hover:file:bg-jessa-maroon/20 transition-all cursor-pointer border border-gray-200 rounded-xl p-2">
                        </div>

                        <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="showModal = false" class="px-5 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl font-bold transition-colors">Batal</button>
                            <button type="submit" class="px-5 py-2.5 text-white bg-jessa-maroon hover:bg-jessa-maroonDark rounded-xl font-bold shadow-sm transition-colors">Simpan Catatan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
