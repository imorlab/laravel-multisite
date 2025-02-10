<div>
    @if($site->is_main)
        <!-- Hero Section -->
        <section class="h-screen sticky top-0 overflow-hidden bg-neutral-900 mx-4 rounded-2xl my-12">
            <h1 class="title absolute inset-0 grid place-items-center text-white text-[clamp(3vw,2rem,4rem)] font-extrabold mix-blend-difference pointer-events-none z-50 pb-12">
                {!! __($title) !!}
            </h1>

            <div class="gallery absolute inset-0 z-10 flex justify-center w-full h-full">
                @foreach($this->getGalleryImages() as $chunk)
                <div class="col flex-1 flex flex-col w-full">
                    @foreach($chunk as $num)
                    <div class="image-wrapper w-full p-4">
                        <div class="group relative">
                            <div class="absolute -inset-2 opacity-0 group-hover:opacity-100 transition-all duration-500"
                                 style="background-image: url('{{ asset("sites/BEN/gallery/ben-{$num}.jpg") }}');
                                        background-position: center;
                                        background-size: cover;
                                        filter: blur(30px) brightness(1.5) saturate(2);
                                        transform: scale(1.03);
                                        z-index: -1;">
                            </div>
                            <img src="{{ asset("sites/BEN/gallery/ben-{$num}.jpg") }}"
                                 alt=""
                                 class="relative z-10 w-full h-full object-cover shadow-lg group-hover:shadow-2xl group-hover:brightness-110 group-hover:saturate-150 transition-all duration-500">
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>

            <!-- <h2 class="credit absolute bottom-4 right-4 text-sm writing-vertical-rl">
                <a href="#" class="text-white">{{ $site->name }}</a>
            </h2> -->
        </section>

        <!-- Content Section -->
        <section class="relative min-h-screen overflow-hidden"
                x-data="{
                    videoEnded: false,
                    isMuted: true,
                    videoStarted: false,
                    async startVideo() {
                        const video = this.$refs.video;
                        if (!this.videoStarted && video) {
                            try {
                                await video.play();
                                this.videoStarted = true;
                            } catch (error) {
                                console.error('Error reproduciendo video:', error);
                            }
                        }
                    },
                    toggleMute() {
                        this.isMuted = !this.isMuted;
                        this.$refs.video.muted = this.isMuted;
                    }
                }"
                x-init="$nextTick(() => {
                    const video = $refs.video;

                    video.addEventListener('ended', () => {
                        videoEnded = true;
                    });

                    // Observar cuando la sección es visible
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting && !videoStarted) {
                                startVideo();
                            }
                        });
                    }, { threshold: 0.1 });

                    observer.observe($el);
                })">
            <!-- Video de fondo -->
            <div class="absolute inset-0">
                <video x-ref="video"
                       class="w-full h-full object-cover transition-opacity duration-1000"
                       :class="{ 'opacity-0': videoEnded }"
                       playsinline
                       preload="auto"
                       muted
                       :muted="isMuted">
                    <source src="{{ asset('video/BEON-ENT-compress.mp4') }}" type="video/mp4">
                </video>

                <!-- Overlay -->
                {{-- <div class="absolute inset-0 bg-gradient-to-b from-neutral-900/70 via-neutral-900/50 to-neutral-900/90"></div> --}}
            </div>

            <!-- Botón de audio (fuera del contenedor de video) -->
            <div class="absolute bottom-8 right-8" style="z-index: 9999;">
                <button @click="toggleMute"
                        class="p-3 rounded-full bg-neutral-900/60 backdrop-blur-sm hover:bg-neutral-800/80 transition-all duration-300 group">
                    <svg x-show="isMuted" class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                    </svg>
                    <svg x-show="!isMuted" class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                    </svg>

                    <!-- Tooltip -->
                    <span class="absolute right-full mr-2 top-1/2 -translate-y-1/2 px-2 py-1 bg-neutral-900/90 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                        <span x-text="isMuted ? 'Activar audio' : 'Silenciar'"></span>
                    </span>
                </button>
            </div>

            <!-- Contenido -->
            <div class="relative z-10 min-h-screen flex items-center"
                 :class="{ 'opacity-100': videoEnded, 'opacity-0': !videoEnded }"
                 style="transition: opacity 1000ms ease-out;">
                <div class="container mx-auto px-8">
                    <div class="max-w-3xl mx-auto bg-neutral-900/80 backdrop-blur-sm text-gray-300 p-8 md:p-12 rounded-2xl transform transition-all duration-1000 ease-out shadow-2xl"
                         :class="{ 'translate-y-0': videoEnded, 'translate-y-12': !videoEnded }">
                        @if(is_array($content) && isset($content[$locale]))
                            <h2 class="text-4xl text-orange-600 font-bold mb-2">{{ $content[$locale]['title'] }}</h2>
                            <p class="text-2xl text-orange-400 font-light mb-6">{{ $content[$locale]['subtitle'] }}</p>

                            <div class="space-y-6">
                                <p class="text-xl">{{ $content[$locale]['intro'] }}</p>
                                <p class="text-lg">{{ $content[$locale]['mission'] }}</p>
                                <p class="text-lg italic">{{ $content[$locale]['closing'] }}</p>
                            </div>
                        @else
                            <div class="prose prose-lg prose-invert">
                                {!! $content !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
        <script>
            document.addEventListener('livewire:navigated', () => {
                console.clear();
                gsap.registerPlugin(ScrollTrigger);

                // Animación del título
                gsap.to(".title", {
                    scrollTrigger: {
                        trigger: "section",
                        start: "top top",
                        end: "bottom top",
                        scrub: 1
                    },
                    y: "-50vh",
                    scale: 0.8,
                    opacity: 0
                });

                const additionalY = { val: 0 };
                let additionalYAnim;
                let offset = 0;
                const cols = gsap.utils.toArray(".col");

                cols.forEach((col, i) => {
                    const images = col.childNodes;

                    // Duplicar imágenes para el loop
                    images.forEach((image) => {
                        if (image.nodeType === 1) { // Solo clonar elementos, no nodos de texto
                            var clone = image.cloneNode(true);
                            col.appendChild(clone);
                        }
                    });

                    // Configurar animación
                    images.forEach((item) => {
                        if (item.nodeType === 1) { // Solo animar elementos, no nodos de texto
                            let columnHeight = item.parentElement.clientHeight;
                            let direction = i % 2 !== 0 ? "+=" : "-="; // Cambiar dirección para columnas impares

                            gsap.to(item, {
                                y: direction + Number(columnHeight / 2),
                                duration: 20,
                                repeat: -1,
                                ease: "none",
                                modifiers: {
                                    y: gsap.utils.unitize((y) => {
                                        if (direction == "+=") {
                                            offset += additionalY.val;
                                            y = (parseFloat(y) - offset) % (columnHeight * 0.5);
                                        } else {
                                            offset += additionalY.val;
                                            y = (parseFloat(y) + offset) % -Number(columnHeight * 0.5);
                                        }
                                        return y;
                                    })
                                }
                            });
                        }
                    });
                });

                ScrollTrigger.create({
                    trigger: "section",
                    start: "top 50%",
                    end: "bottom 50%",
                    onUpdate: function (self) {
                        const velocity = self.getVelocity();
                        if (velocity > 0) {
                            if (additionalYAnim) additionalYAnim.kill();
                            additionalY.val = -velocity / 2000;
                            additionalYAnim = gsap.to(additionalY, { val: 0 });
                        }
                        if (velocity < 0) {
                            if (additionalYAnim) additionalYAnim.kill();
                            additionalY.val = -velocity / 3000;
                            additionalYAnim = gsap.to(additionalY, { val: 0 });
                        }
                    }
                });
            });
        </script>
        @endpush

        @push('styles')
        <style>
            h1 {
                font-weight: 800;
                margin: 2rem auto;
                font-size: clamp(3vw, 2rem, 4rem);
                text-align: center;
                z-index: 999;
                max-width: 800px;
                mix-blend-mode: difference;
                pointer-events: none;
                color: white;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                display: grid;
                place-items: center;
            }

            @media (max-width: 768px) {
                .gallery {
                    width: 160%;
                }
            }

            .col {
                display: flex;
                flex: 1;
                flex-direction: column;
                width: 100%;
                align-self: flex-start;
                justify-self: flex-start;
            }

            .col:nth-child(2) {
                align-self: flex-end;
                justify-self: flex-end;
            }

            .image-container {
                position: relative;
                z-index: 1;
            }

            .image-container::after {
                content: '';
                position: absolute;
                inset: 0;
                z-index: -1;
                background-image: inherit;
                opacity: 0;
                filter: blur(40px) saturate(200%);
                transition: opacity 0.5s ease;
            }

            .image-container:hover::after {
                opacity: 1;
            }
        </style>
        @endpush

        @else
        <div class="min-h-screen flex flex-col">
            <!-- Hero Section con imagen de fondo -->
            <div class="relative h-[40vh] bg-cover bg-center bg-gray-900"
                 @if($site->hasImage('background.jpg'))
                 style="background-image: url('{{ $site->getSiteImage('background.jpg') }}')"
                 @endif
            >
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="container mx-auto px-4">
                        <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold text-center mb-4">
                            {{ $title }}
                        </h1>
                    </div>
                </div>
            </div>

            <!-- Contenido Principal -->
            <div class="flex-grow bg-gray-900">
                <div class="container mx-auto px-4 py-12">
                    <div class="bg-gray-800 rounded-lg shadow-xl p-8">
                        <div class="prose prose-lg prose-invert max-w-none">
                            {!! $content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
