<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Pemilik Kost') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold">Ringkasan Eksekutif</h1>
                    <p class="text-gray-500 mt-1">Performa bisnis periode bulan ini.</p>
                </div>
            </header>

            <!-- Finance Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 border-l-4 border-l-green-500">
                    <p class="text-sm text-gray-500">Total Pemasukan (Dibayar)</p>
                    <p class="text-3xl font-bold mt-2">Rp {{ number_format($income, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 border-l-4 border-l-red-500">
                    <p class="text-sm text-gray-500">Sewa Belum Dibayar</p>
                    <p class="text-3xl font-bold mt-2">{{ $unpaidRent }} <span class="text-base font-normal text-gray-500">Tagihan</span></p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 border-l-4 border-l-orange-500">
                    <p class="text-sm text-gray-500">Persetujuan Pending</p>
                    <p class="text-3xl font-bold mt-2">{{ $pendingApprovals->count() }} <span class="text-base font-normal text-gray-500">Tiket</span></p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Approval System -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col lg:col-span-3">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold flex items-center">Persetujuan Dana Operasional</h2>
                    </div>
                    <div class="p-6 flex-1 space-y-4">
                        @if($pendingApprovals->isEmpty())
                            <p class="text-gray-500">Tidak ada pengajuan dana yang butuh persetujuan.</p>
                        @else
                            @foreach($pendingApprovals as $ticket)
                            <div class="border border-gray-200 p-4 rounded-xl bg-blue-50">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-semibold text-base">{{ $ticket->title }}</h3>
                                        <p class="text-xl font-bold text-blue-600 mt-1">Rp {{ number_format($ticket->cost, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mt-2 mb-4">{{ $ticket->description }}</p>
                                <div class="flex gap-2">
                                    <button class="bg-green-500 text-white py-2 px-4 rounded-lg text-sm hover:bg-green-600 font-medium">Approve</button>
                                    <button class="bg-red-500 text-white py-2 px-4 rounded-lg text-sm hover:bg-red-600 font-medium">Reject</button>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

