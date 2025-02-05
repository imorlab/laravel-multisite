<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="min-h-screen bg-neutral-900 flex flex-col">
    
    <div>
        <!-- Navigation -->
        <nav class="bg-neutral-900 shadow-lg w-full">
            <div class="px-4 sm:px-6 lg:px-12">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ $site->is_main ? url('/') : url('/' . $site->domain) }}" class="text-2xl font-bold text-gray-100">
                                <img class="h-12 w-auto filter brightness-0 invert" src="{{ asset('resources/logo-entertaiment.svg') }}" alt="{{ $site->getName() }}">
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <livewire:language-switcher />
                    </div>
                </div>
            </div>
        </nav>
    </div>
    
    <!-- Page Content -->
    <main class="flex-grow w-full">
        @yield('content')
    </main>


    @if(!$site->is_main)
    <!-- Footer -->
    <footer class="bg-neutral-900 shadow-lg mt-auto w-full">
        <div class="px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center text-gray-400">
                &copy; {{ date('Y') }} {{ $site->getName() }}. {{ __('content.all_rights_reserved') }}.
            </div>
        </div>
    </footer>
    @endif

    @livewireScripts
    @stack('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('language-changed', () => {
                window.location.reload();
            });
        });
    </script>
</body>
</html>
