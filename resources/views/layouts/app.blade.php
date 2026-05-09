<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TukarMinyak.Id - Sistem Pengelolaan Limbah</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,700,900" rel="stylesheet" />

        <!-- SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            html {
                scroll-behavior: smooth;
            }
            /* Custom Scrollbar agar senada dengan tema hijau */
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: #f1f1f1; }
            ::-webkit-scrollbar-thumb { background: #064e3b; border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: #059669; }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="min-h-screen bg-gray-50">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white border-b border-gray-200 shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>