<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-neutral-900 flex flex-col">
    <div>
        <!-- Navigation -->
        <nav class="bg-neutral-900 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ $site->is_main ? url('/') : url('/' . $site->domain) }}" class="text-2xl font-bold text-gray-100">
                                {{ $site->getName() }}
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <livewire:language-switcher />
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow" wire:poll.10s>
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-neutral-900 shadow-lg mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-gray-400">
                &copy; {{ date('Y') }} {{ $site->getName() }}. {{ __('Todos los derechos reservados') }}.
            </div>
        </div>
    </footer>

    @livewireScripts
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('language-changed', () => {
                console.log('Language changed event received');
                Livewire.dispatch('language-changed');
            });
        });
    </script>
</body>
</html>
