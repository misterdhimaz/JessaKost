<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-jessa-maroon/10 rounded-xl flex items-center justify-center text-jessa-maroon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Pengumuman Kost</h2>
                <p class="text-sm text-gray-400 font-medium">Informasi terbaru dari pengelola kost</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6 max-w-4xl">
        @forelse($announcements as $announcement)
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden relative">
            @if($announcement->priority == 'urgent')
                <div class="absolute top-0 left-0 w-full h-1 bg-red-500"></div>
            @elseif($announcement->priority == 'important')
                <div class="absolute top-0 left-0 w-full h-1 bg-yellow-500"></div>
            @else
                <div class="absolute top-0 left-0 w-full h-1 bg-blue-500"></div>
            @endif

            <div class="p-6">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0
                        @if($announcement->priority == 'urgent') bg-red-50 text-red-500
                        @elseif($announcement->priority == 'important') bg-yellow-50 text-yellow-500
                        @else bg-blue-50 text-blue-500 @endif
                    ">
                        @if($announcement->priority == 'urgent') <i class="fas fa-exclamation-triangle"></i>
                        @elseif($announcement->priority == 'important') <i class="fas fa-exclamation-circle"></i>
                        @else <i class="fas fa-info-circle"></i> @endif
                    </div>
                    <div>
                        <h3 class="font-extrabold text-gray-900 text-lg sm:text-xl">{{ $announcement->title }}</h3>
                        <p class="text-sm text-gray-400 font-medium mt-0.5">
                            <i class="far fa-clock mr-1"></i> {{ $announcement->created_at->translatedFormat('d M Y, H:i') }}
                        </p>
                    </div>
                </div>

                <div class="prose prose-sm sm:prose max-w-none text-gray-600 pl-16">
                    <p class="whitespace-pre-line">{{ $announcement->body }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-10 text-center">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-4xl text-gray-400 mx-auto mb-4">
                <i class="fas fa-inbox"></i>
            </div>
            <h4 class="font-extrabold text-gray-900 text-xl mb-2">Belum Ada Pengumuman</h4>
            <p class="text-gray-500 font-medium">Saat ini tidak ada informasi baru dari pengelola kost.</p>
        </div>
        @endforelse
    </div>
</x-app-layout>

