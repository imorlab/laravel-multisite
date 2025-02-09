@props(['site'])

<!-- Navigation Component -->
<div x-data="{ 
    isMenuOpen: false,
    isScrolled: false
}" 
class="relative"
@scroll.window="isScrolled = (window.pageYOffset > 20)">
    <!-- Main Navigation Bar -->
    <div class="fixed md:top-0 bottom-0 md:bottom-auto left-0 right-0 mx-4 md:mx-0 z-50 md:mt-4">
        <div class="mx-auto max-w-3xl relative transition-all duration-300"
            :class="{
                'max-w-4xl': isMenuOpen
            }">
            <!-- Contenedor principal con bordes redondeados -->
            <div class="rounded-2xl transition-all duration-300 bg-neutral-900/80 backdrop-blur"
                :class="{
                    'bg-opacity-0 backdrop-blur-none': !isScrolled && !isMenuOpen,
                    'bg-opacity-90': isScrolled || isMenuOpen,
                    'md:rounded-b-none rounded-t-none': isMenuOpen
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
                    class="absolute md:top-full bottom-full w-full"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform md:translate-y-[-1rem] translate-y-[1rem]"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform md:translate-y-[-1rem] translate-y-[1rem]">
                    <div class="bg-neutral-900/90 backdrop-blur rounded-t-2xl md:rounded-t-none md:rounded-b-2xl transform transition-all duration-300">
                        <!-- Contenedor con scroll -->
                        <div class="max-h-[calc(100vh-10rem)] md:max-h-[32rem] overflow-y-auto overscroll-contain px-4 py-8">
                            <nav>
                                @if($site->is_main)
                                <!-- 1 columna para móvil, 2 para desktop -->
                                <div class="grid md:grid-cols-2 gap-8 text-white">
                                    <div class="space-y-6 space-x-4">
                                        <h3 class="text-sm font-small text-gray-400 tracking-wider">{{ __('Explore by') }}</h3>
                                        <div class="space-y-4">
                                            <a href="#" class="block text-xl hover:text-gray-300">La Productora</a>
                                            <a href="#" class="block text-xl hover:text-gray-300">Producciones</a>
                                            <a href="#" class="block text-xl hover:text-gray-300">Grupos</a>
                                            <a href="#" class="block text-xl hover:text-gray-300">Cuentanos tu proyecto</a>
                                            <a href="#" class="block text-xl hover:text-gray-300">Actualidad</a>
                                        </div>
                                    </div>
                                    <div class="space-y-6">
                                        <h3 class="text-sm font-small text-gray-400 tracking-wider">{{ __('Recommended') }}</h3>
                                        <div class="swiper showsSwiper w-[225px] h-[300px] relative">
                                            <!-- Botones de navegación -->
                                            <div class="absolute left-2 top-1/2 -translate-y-1/2 z-10">
                                                <button id="prevButton" class="flex items-center justify-center w-8 h-8 rounded-full bg-white shadow-lg hover:bg-gray-50 transition-all duration-300">
                                                    <svg class="w-6 h-6 text-black" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M14.71 6.71a.996.996 0 0 0-1.41 0L8.71 11.3a.996.996 0 0 0 0 1.41l4.59 4.59a.996.996 0 1 0 1.41-1.41L10.83 12l3.88-3.88c.39-.39.38-1.03 0-1.41z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="absolute right-2 top-1/2 -translate-y-1/2 z-10">
                                                <button id="nextButton" class="flex items-center justify-center w-8 h-8 rounded-full bg-white shadow-lg hover:bg-gray-50 transition-all duration-300">
                                                    <svg class="w-6 h-6 text-black" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M9.29 6.71a.996.996 0 0 0 0 1.41L13.17 12l-3.88 3.88a.996.996 0 1 0 1.41 1.41l4.59-4.59a.996.996 0 0 0 0-1.41L10.7 6.7c-.38-.38-1.02-.38-1.41.01z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide aspect-[3/4]">
                                                    <div class="relative w-full h-full rounded-lg overflow-hidden group">
                                                        <img src="{{ asset('sites/thumb/EM-CARTEL-450x600.jpg') }}" 
                                                             alt="El Médico" 
                                                             class="w-full h-full object-cover">
                                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                            <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                                                                <h4 class="text-white text-xl font-semibold">El Médico</h4>
                                                                <p class="text-gray-300 mt-2 text-sm">El Musical</p>
                                                                <a href="#" class="inline-block px-6 py-2 mt-4 text-sm text-white border border-white/50 rounded-full hover:bg-white/10 transition-colors duration-300">
                                                                    {{ __('Ver más') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide aspect-[3/4]">
                                                    <div class="relative w-full h-full rounded-lg overflow-hidden group">
                                                        <img src="{{ asset('sites/thumb/LHI-CARTEL-450x600.jpg') }}" 
                                                             alt="La Historia Interminable" 
                                                             class="w-full h-full object-cover">
                                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                            <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                                                                <h4 class="text-white text-xl font-semibold">La Historia Interminable</h4>
                                                                <p class="text-gray-300 mt-2 text-sm">El Musical</p>
                                                                <a href="#" class="inline-block px-6 py-2 mt-4 text-sm text-white border border-white/50 rounded-full hover:bg-white/10 transition-colors duration-300">
                                                                    {{ __('Ver más') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide aspect-[3/4]">
                                                    <div class="relative w-full h-full rounded-lg overflow-hidden group">
                                                        <img src="{{ asset('sites/thumb/LPDLT-CARTEL-450x600.jpg') }}" 
                                                             alt="Los Pilares de la Tierra" 
                                                             class="w-full h-full object-cover">
                                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                            <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                                                                <h4 class="text-white text-xl font-semibold">Los Pilares de la Tierra</h4>
                                                                <p class="text-gray-300 mt-2 text-sm">El Musical</p>
                                                                <a href="#" class="inline-block px-6 py-2 mt-4 text-sm text-white border border-white/50 rounded-full hover:bg-white/10 transition-colors duration-300">
                                                                    {{ __('Ver más') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let swiper = null;
        
        function initSwiper() {
            if (!swiper) {
                swiper = new Swiper('.showsSwiper', {
                    effect: 'cards',
                    grabCursor: true,
                    loop: true,
                    loopedSlides: 3,
                    slidesPerView: 'auto',
                    speed: 400,
                    initialSlide: 1,
                    centeredSlides: true,
                    allowTouchMove: true,
                    cardsEffect: {
                        slideShadows: true,
                        perSlideOffset: 12,
                        perSlideRotate: 4,
                        rotate: true,
                    },
                    navigation: {
                        nextEl: '#nextButton',
                        prevEl: '#prevButton',
                    },
                    on: {
                        init: function() {
                            this.snapGrid = [...this.slidesGrid];
                        },
                        touchEnd: function() {
                            const activeIndex = this.activeIndex;
                            setTimeout(() => {
                                this.slideTo(activeIndex, 300);
                            }, 0);
                        }
                    },
                });

                const swiperEl = document.querySelector('.showsSwiper');
                swiperEl.addEventListener('touchstart', function(e) {
                    swiper.allowTouchMove = true;
                }, { passive: true });

                document.querySelector('#nextButton').addEventListener('click', function() {
                    swiper.slideNext(400);
                });
                document.querySelector('#prevButton').addEventListener('click', function() {
                    swiper.slidePrev(400);
                });
            }
        }

        const menuButton = document.querySelector('[aria-label="Menú"]');
        menuButton.addEventListener('click', function() {
            setTimeout(initSwiper, 50);
        });
    });
</script>
@endpush
