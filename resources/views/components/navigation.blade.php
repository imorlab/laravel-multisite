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
            <div class="rounded-2xl transition-all duration-300"
                :class="{
                    'bg-secondary-500/10 backdrop-blur': !isScrolled && !isMenuOpen,
                    'bg-secondary-500/90 backdrop-blur': isScrolled || isMenuOpen,
                    'md:rounded-b-none md:rounded-t-2xl rounded-b-2xl rounded-t-none': isMenuOpen
                }">
                <div class="flex justify-between items-center px-4 py-3">
                    <!-- Button -->
                    <div class="w-36">
                        <a href="#" class="group relative px-4 py-2 text-orange-500 font-medium overflow-hidden rounded-lg hover:text-orange-300 transition-colors duration-300">
                            <div class="absolute inset-0 w-1/2 h-full bg-gradient-to-r from-orange-500/0 via-orange-500/30 to-orange-500/0 skew-x-[-20deg] group-hover:animate-shine"></div>
                            <div class="absolute inset-0 border border-orange-500 rounded-lg group-hover:border-orange-300 transition-colors duration-300"></div>
                            <span class="relative">{{ __('Entradas') }}</span>
                        </a>
                    </div>

                    <!-- Logo -->
                    <a href="{{ $site->is_main ? url('/') : url('/' . $site->domain) }}" class="flex items-center relative z-10">
                        <img class="h-12 w-auto" src="{{ asset('resources/logo-entertainment.svg') }}" alt="{{ $site->getName() }}">
                    </a>

                    <!-- Menu Button -->
                    <div class="w-36 flex justify-end">
                        <button @click="isMenuOpen = !isMenuOpen" class="p-2 text-white relative z-10" aria-label="Menú">
                            <svg x-show="!isMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                            <svg x-show="isMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
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
                    <div class="bg-secondary-500/90 backdrop-blur rounded-t-2xl md:rounded-t-none md:rounded-b-2xl transform transition-all duration-300">
                        <!-- Contenedor con scroll -->
                        <div class="max-h-[calc(100vh-10rem)] md:max-h-[32rem] overflow-y-auto overscroll-contain px-8 py-8">
                            <nav>
                                @if($site->is_main)
                                <!-- 1 columna para móvil, 2 para desktop -->
                                <div class="grid md:grid-cols-2 text-white">
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
                                        <div class="overflow-hidden">
                                            <div class="swiper showsSwiper w-[225px] h-[300px] relative">
                                                <!-- Botones de navegación -->
                                                <div class="absolute left-0 top-1/2 -translate-y-1/2 z-10">
                                                    <button id="prevButton" class="flex items-center justify-center w-8 h-8 rounded-full bg-white shadow-lg hover:bg-gray-50 transition-all duration-300">
                                                        <svg class="w-6 h-6 text-black" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M14.71 6.71a.996.996 0 0 0-1.41 0L8.71 11.3a.996.996 0 0 0 0 1.41l4.59 4.59a.996.996 0 1 0 1.41-1.41L10.83 12l3.88-3.88c.39-.39.38-1.03 0-1.41z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="absolute right-0 top-1/2 -translate-y-1/2 z-10">
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
                                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                                                <h4 class="text-white text-lg font-semibold">El Médico</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide aspect-[3/4]">
                                                        <div class="relative w-full h-full rounded-lg overflow-hidden group">
                                                            <img src="{{ asset('sites/thumb/LPDLT-CARTEL-450x600.jpg') }}"
                                                                 alt="Los Pilares de la Tierra"
                                                                 class="w-full h-full object-cover">
                                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                                                <h4 class="text-white text-lg font-semibold">Los Pilares de la Tierra</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide aspect-[3/4]">
                                                        <div class="relative w-full h-full rounded-lg overflow-hidden group">
                                                            <img src="{{ asset('sites/thumb/ANT-CARTEL-450x600.jpg') }}"
                                                                 alt="Antidisturbios"
                                                                 class="w-full h-full object-cover">
                                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                                                <h4 class="text-white text-lg font-semibold">Antidisturbios</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide aspect-[3/4]">
                                                        <div class="relative w-full h-full rounded-lg overflow-hidden group">
                                                            <img src="{{ asset('sites/thumb/MOZ-CARTEL-450x600.jpg') }}"
                                                                 alt="Mozart"
                                                                 class="w-full h-full object-cover">
                                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                                                <h4 class="text-white text-lg font-semibold">Mozart</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide aspect-[3/4]">
                                                        <div class="relative w-full h-full rounded-lg overflow-hidden group">
                                                            <img src="{{ asset('sites/thumb/SH-CARTEL-450x600.jpg') }}"
                                                                 alt="Sherlock Holmes"
                                                                 class="w-full h-full object-cover">
                                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                                                <h4 class="text-white text-lg font-semibold">Sherlock Holmes</h4>
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
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    loopedSlides: 5,
                    speed: 400,
                    initialSlide: 0,
                    centeredSlides: true,
                    allowTouchMove: true,
                    cardsEffect: {
                        slideShadows: true,
                        perSlideOffset: 8,
                        perSlideRotate: 2,
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
