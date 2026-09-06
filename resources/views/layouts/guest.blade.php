<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Autentikasi - Jessa Kost</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-jessa-cream selection:bg-jessa-maroon/20 selection:text-jessa-maroon min-h-screen relative flex items-center justify-center overflow-x-hidden p-4 sm:p-6">

    <!-- Modern Animated Background (Subtle) -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <!-- Subtle Pattern -->
        <div class="absolute inset-0 opacity-40" style="background-image: radial-gradient(rgba(146,0,58,0.06) 2px, transparent 2px); background-size: 32px 32px;"></div>

        <!-- Glowing Blobs -->
        <div class="absolute top-1/4 left-1/4 w-[40vw] h-[40vw] bg-white rounded-full mix-blend-overlay filter blur-[80px] opacity-80 animate-blob"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[30vw] h-[30vw] bg-jessa-maroon/5 rounded-full mix-blend-multiply filter blur-[80px] animate-blob animation-delay-2000"></div>
    </div>

    <!-- Back to Home Link (Absolute Top Left) -->
    <a href="{{ route('home') }}" class="absolute top-6 left-6 md:top-10 md:left-10 z-20 inline-flex items-center gap-2 text-gray-500 hover:text-jessa-maroon transition-colors text-sm font-bold bg-white/50 backdrop-blur-md px-4 py-2 rounded-full border border-gray-200 shadow-sm hover:shadow-md">
        <i class="fas fa-arrow-left"></i> <span class="hidden sm:inline">Kembali ke Beranda</span>
    </a>

    <!-- Centered Container -->
    <div class="w-full max-w-md relative z-10 flex flex-col items-center">

        <!-- Center Logo Box with Thin Maroon Roof -->
        <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center text-jessa-maroon text-4xl mb-8 shadow-xl border-t-[5px] border-jessa-maroon relative transform hover:scale-105 transition-transform duration-300 z-20">
            <!-- Tempat logo asli nanti bisa dimasukkan tag <img> di sini, menggantikan tag <i> -->
            <i class="fas fa-leaf"></i>
            <!-- Glow effect under logo -->
            <div class="absolute inset-0 bg-jessa-maroon/20 filter blur-xl rounded-full -z-10 translate-y-2"></div>
        </div>

        <!-- Modern Auth Card -->
        <div class="w-full bg-white/95 backdrop-blur-xl rounded-[2.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.05)] border border-white p-8 sm:p-10 relative overflow-hidden">
            <!-- Decorative Accent inside Card -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-jessa-cream rounded-full mix-blend-multiply filter blur-2xl opacity-50 -z-10 translate-x-1/2 -translate-y-1/2"></div>

            {{ $slot }}

        </div>

        <!-- Footer Text -->
        <div class="mt-10 text-center">
            <p class="text-sm text-gray-500 font-medium">
                &copy; {{ date('Y') }} Jessa Kost. Sistem Manajemen Pintar.
            </p>
        </div>
    </div>

</body>
</html>
