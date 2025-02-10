@props(['site'])

<!-- Navigation Component -->
<div x-data="{ 
    isMenuOpen: false,
    isScrolled: false
}" 
class="relative"
@scroll.window="isScrolled = (window.pageYOffset > 20)">
    <!-- Main Navigation Bar -->
    <div class="fixed top-0 left-0 right-0 z-50">
        <div class="mx-auto max-w-3xl relative transition-all duration-300 mt-4"
            :class="{
                'max-w-4xl': isMenuOpen
            }">
            <!-- Contenedor principal con bordes redondeados -->
            <div class="rounded-2xl transition-all duration-300 bg-neutral-700/90 backdrop-blur"
                :class="{
                    'bg-opacity-0 backdrop-blur-none': !isScrolled && !isMenuOpen,
                    'bg-opacity-90': isScrolled || isMenuOpen
                }">
                <div class="flex justify-between items-center px-4 py-3">
                    <!-- Search Button -->
                    <a href="#" class="group relative px-4 py-1 text-orange-500 font-medium overflow-hidden rounded-lg hover:text-orange-300 transition-colors duration-300">
                        <div class="absolute inset-0 w-1/2 h-full bg-gradient-to-r from-orange-500/0 via-orange-500/30 to-orange-500/0 skew-x-[-20deg] group-hover:animate-shine"></div>
                        <div class="absolute inset-0 border border-orange-500 rounded-lg group-hover:border-orange-300 transition-colors duration-300"></div>
                        <span class="relative">{{ __('Entradas') }}</span>
                    </a>

                    <!-- Logo -->
                    <a href="{{ $site->is_main ? url('/') : url('/' . $site->domain) }}" class="flex items-center relative z-10">
                        <img class="h-12 w-auto" src="{{ asset('resources/logo-entertainment.svg') }}" alt="{{ $site->getName() }}">
                    </a>

                    <!-- Menu Button -->
                    <button @click="isMenuOpen = !isMenuOpen" class="p-2 text-white relative z-10" aria-label="Menú">
                        <svg x-show="!isMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg x-show="isMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Menu Overlay -->
                <div x-show="isMenuOpen" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="w-full rounded-b-2xl">
                    <div class="px-4 py-8">
                        <nav>
                            @if($site->is_main)
                            <!-- 2 columnas para el sitio principal -->
                            <div class="grid grid-cols-2 gap-8 text-white">
                                <div class="space-y-6">
                                    <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Explore by') }}</h3>
                                    <div class="space-y-4">
                                        <a href="#" class="block text-xl hover:text-gray-300">LA PRODUCTORA</a>
                                        <a href="#" class="block text-xl hover:text-gray-300">PRODUCCIONES</a>
                                        <a href="#" class="block text-xl hover:text-gray-300">GRUPOS</a>
                                        <a href="#" class="block text-xl hover:text-gray-300">CUÉNTANOS TU PROYECTO</a>
                                        <a href="#" class="block text-xl hover:text-gray-300">ACTUALIDAD</a>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Recommended') }}</h3>
                                    <!-- Aquí irá el swiper con los espectáculos -->
                                </div>
                            </div>
                            @else
                            <!-- 3 columnas para los demás sitios -->
                            <div class="grid grid-cols-3 gap-8 text-white">
                                <div class="space-y-6">
                                    <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Explore by') }}</h3>
                                    <div class="space-y-4">
                                        <a href="#" class="block text-xl hover:text-gray-300">LA PRODUCTORA</a>
                                        <a href="#" class="block text-xl hover:text-gray-300">PRODUCCIONES</a>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Recommended') }}</h3>
                                    <div class="space-y-4">
                                        <a href="#" class="block text-xl hover:text-gray-300">GRUPOS</a>
                                        <a href="#" class="block text-xl hover:text-gray-300">CUÉNTANOS TU PROYECTO</a>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <!-- Pendiente de definir el título -->
                                    <div class="space-y-4">
                                        <a href="#" class="block text-xl hover:text-gray-300">ACTUALIDAD</a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Language Switcher -->
                            <div class="mt-8 text-center text-white">
                                <livewire:language-switcher />
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
