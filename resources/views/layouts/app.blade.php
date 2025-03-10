<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <style>[x-cloak]{display:none !important;}</style>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    @livewireStyles
    @stack('styles')
</head>
<body class="min-h-screen bg-tertiary-500 flex flex-col">
    <div class="my-0 md:my-6">
        <x-navigation :site="$site" />
    </div>

    <main class="flex-grow w-full">
        @yield('content')
    </main>

    <x-footer :site="$site" />
    <x-scroll-to-top />

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('language-changed', (event) => {
                window.location.reload();
            });
        });
    </script>
</body>
</html>
