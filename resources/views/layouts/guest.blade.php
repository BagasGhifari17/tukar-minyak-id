<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TukarMinyak.Id - Masuk</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,700,900" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Background dengan Gradien Hijau Tua -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-[#064e3b] via-[#043d2e] to-[#022c22]">
            
            <div class="mb-8 animate-bounce">
                <a href="/">
                    <div class="bg-emerald-500 p-4 rounded-[2rem] shadow-2xl shadow-emerald-500/40">
                        <svg class="w-12 h-12 text-emerald-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white/95 backdrop-blur-xl shadow-[0_20px_50px_rgba(0,0,0,0.3)] sm:rounded-[3rem] border border-white/20">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-black text-[#064e3b] uppercase tracking-tighter italic">TukarMinyak.Id</h2>
                    <p class="text-[10px] font-bold text-emerald-600/60 uppercase tracking-[0.2em] mt-1">Sistem Pengelolaan Limbah Pintar</p>
                </div>

                {{ $slot }}
            </div>

            <p class="mt-8 text-emerald-100/40 text-[10px] font-bold uppercase tracking-widest italic">
                &copy; 2026 Muhammad Bagas Ghifari - Politeknik Negeri Jember
            </p>
        </div>
    </body>
</html>