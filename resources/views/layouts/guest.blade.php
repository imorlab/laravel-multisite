<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-tertiary-900 via-tertiary-800 to-primary-900">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="flex justify-center mb-8 animate-fade-in-down">
                    <img src="{{ asset('resources/logo-entertainment.svg') }}" alt="beon. Entertainment" class="h-24">
                </div>

                <!-- Card de Login -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 animate-fade-in-up">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
