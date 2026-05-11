<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'YKIP Admin') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans text-gray-900 antialiased font-inter-custom">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#FDFBF7] bg-beans-pattern">

            <div class="mb-8 text-center flex flex-col items-center">
                <svg class="w-12 h-12 text-[#D4A373] mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
                <h1 class="font-serif text-3xl font-bold text-[#3E2723]">YKIP Admin Portal</h1>
                <p class="text-sm text-gray-500 mt-2">Masuk untuk mengelola data donasi</p>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-10 py-10 bg-white shadow-2xl border border-gray-100 overflow-hidden sm:rounded-[2rem]">
                {{ $slot }}
            </div>

            <div class="mt-12 text-xs text-gray-400">
                &copy; {{ date('Y') }} Yayasan Kemanusiaan Ibu Pertiwi. All rights reserved.
            </div>
        </div>
    </body>
</html>
