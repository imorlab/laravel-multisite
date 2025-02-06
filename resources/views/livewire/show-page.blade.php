<div>
    @if($site->is_main)
        <!-- Hero Section -->
        <section class="h-screen sticky top-0 overflow-hidden">
            <h1 class="title absolute inset-0 grid place-items-center text-white text-[clamp(3vw,2rem,4rem)] font-extrabold mix-blend-difference pointer-events-none z-50 pb-12">
                {!! __($title) !!}
            </h1>

            <div class="gallery absolute inset-0 z-10 flex justify-center w-full h-full">
                @foreach($this->getGalleryImages() as $chunk)
                <div class="col flex-1 flex flex-col w-full">
                    @foreach($chunk as $num)
                    <div class="image w-full filter saturate-0 hover:saturate-100 p-4 transition-all duration-300">
                        <img src="{{ asset("sites/BEN/gallery/ben-{$num}.jpg") }}"
                             alt=""
                             class="w-full shadow-2xl transition-transform duration-300">
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>

            <h2 class="credit absolute bottom-4 right-4 text-sm writing-vertical-rl">
                <a href="#" class="text-white">{{ $site->name }}</a>
            </h2>
        </section>

        <!-- Content Section -->
        <section class="relative min-h-screen"
                x-data="{
                    isFullscreen: false,
                    isMuted: true,
                    videoStarted: false,
                    async startVideo() {
                        if (!this.videoStarted) {
                            const preview = this.$refs.previewVideo;
                            const fullscreen = this.$refs.fullscreenVideo;
                            
                            try {
                                this.isFullscreen = true;
                                // Sincronizar el tiempo de reproducción
                                fullscreen.currentTime = preview.currentTime;
                                await fullscreen.play();
                                this.videoStarted = true;
                            } catch (error) {
                                console.error('Error reproduciendo video:', error);
                                this.isFullscreen = false;
                            }
                        }
                    },
                    stopVideo() {
                        const fullscreen = this.$refs.fullscreenVideo;
                        fullscreen.pause();
                        this.isFullscreen = false;
                        this.videoStarted = false;
                    },
                    toggleMute() {
                        this.isMuted = !this.isMuted;
                        this.$refs.previewVideo.muted = this.isMuted;
                        this.$refs.fullscreenVideo.muted = this.isMuted;
                    }
                }"
                x-init="$nextTick(() => {
                    const preview = $refs.previewVideo;
                    const fullscreen = $refs.fullscreenVideo;

                    // Sincronizar el estado inicial
                    preview.muted = true;
                    fullscreen.muted = true;
                })">
            
            <!-- Contenedor principal con grid -->
            <div class="min-h-screen w-full flex items-center justify-center p-8 transition-all duration-500 ease-in-out transform"
                 :class="{ 'opacity-0 scale-95 pointer-events-none': isFullscreen, 'opacity-100 scale-100': !isFullscreen }">
                <div class="w-full max-w-7xl bg-neutral-900/60 backdrop-blur-sm rounded-2xl p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Columna izquierda: Texto -->
                        <div class="flex flex-col justify-center space-y-6 transition-all duration-500 ease-in-out">
                            @if(is_array($content) && isset($content[$locale]))
                                <h2 class="text-4xl text-orange-600 font-bold transform transition-all duration-500 ease-in-out">{{ $content[$locale]['title'] }}</h2>
                                <h3 class="text-3xl text-orange-200 transform transition-all duration-500 ease-in-out">{{ $content[$locale]['subtitle'] }}</h3>
                                <div class="prose prose-invert max-w-none text-gray-200 transform transition-all duration-500 ease-in-out">
                                    {!! $content[$locale]['intro'] !!}
                                    {!! $content[$locale]['mission'] !!}
                                    {!! $content[$locale]['closing'] !!}
                                </div>
                            @endif
                        </div>

                        <!-- Columna derecha: Video preview -->
                        <div class="relative rounded-xl overflow-hidden group transform transition-all duration-500 ease-in-out hover:shadow-2xl">
                            <!-- Video thumbnail -->
                            <div class="relative aspect-video w-full">
                                <video x-ref="previewVideo"
                                       class="w-full h-full object-cover transform transition-all duration-500 ease-in-out"
                                       playsinline
                                       loop
                                       muted
                                       :muted="isMuted">
                                    <source src="{{ asset('video/BEON-ENT-compress.mp4') }}" type="video/mp4">
                                </video>
                                <!-- Overlay oscuro -->
                                <div class="absolute inset-0 bg-black/50 transition-all duration-500 ease-in-out group-hover:bg-black/40"></div>
                                <!-- Botón de play grande -->
                                <button @click="startVideo"
                                        class="absolute inset-0 flex items-center justify-center transition-all duration-500 ease-in-out transform group-hover:scale-105">
                                    <div class="p-2 rounded-full bg-orange-600/80 group-hover:bg-orange-500/90 transition-all duration-500 ease-in-out transform hover:scale-110">
                                        <svg class="w-12 h-12 text-white transition-all duration-500 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video en pantalla completa -->
            <div class="fixed inset-0 bg-black transition-all duration-700 ease-in-out z-50"
                 :class="{ 'opacity-100 visible': isFullscreen, 'opacity-0 invisible': !isFullscreen }">
                <!-- Video a pantalla completa -->
                <video x-ref="fullscreenVideo"
                       class="w-full h-full object-cover transform transition-all duration-700 ease-in-out"
                       :class="{ 'scale-100 opacity-100': isFullscreen, 'scale-95 opacity-0': !isFullscreen }"
                       playsinline
                       preload="auto"
                       :muted="isMuted">
                    <source src="{{ asset('video/BEON-ENT-compress.mp4') }}" type="video/mp4">
                </video>

                <!-- Controles -->
                <div class="absolute bottom-8 right-8 flex items-center space-x-4 transition-all duration-500 ease-in-out transform"
                     :class="{ 'translate-y-0 opacity-100': isFullscreen, 'translate-y-4 opacity-0': !isFullscreen }">
                    <!-- Botón de cerrar -->
                    <button @click="stopVideo"
                            class="p-3 rounded-full bg-neutral-900/60 backdrop-blur-sm hover:bg-neutral-800/80 transition-all duration-300 ease-in-out transform hover:scale-110">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Botón de audio -->
                    <button @click="toggleMute"
                            class="p-3 rounded-full bg-neutral-900/60 backdrop-blur-sm hover:bg-neutral-800/80 transition-all duration-300 ease-in-out transform hover:scale-110">
                        <svg x-show="isMuted" class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                        </svg>
                        <svg x-show="!isMuted" class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                        </svg>
                    </button>
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
