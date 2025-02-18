<div>
    @if($site->is_main)
        <!-- Hero Section -->
        <section class="h-screen sticky top-0 overflow-hidden bg-neutral-900 mx-0 mt-0 md:mt-12">
            <h1 class="title absolute inset-0 grid place-items-center text-white text-4xl md:text-7xl font-extrabold mix-blend-difference pointer-events-none z-50">
                {!! __($title) !!}
            </h1>

            <div class="gallery absolute inset-0 z-10 flex justify-center w-full h-full">
                @foreach($this->getGalleryImages() as $chunk)
                <div class="col flex-1 flex flex-col w-full">
                    @foreach($chunk as $num)
                    <div class="image-wrapper w-full p-1 md:p-4">
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
        </section>

        <!-- Contenido -->
        <div class="relative z-10 min-h-screen flex items-center content-section"
             x-data="{ show: false }"
             x-init="
                setTimeout(() => show = true, 150);
                    gsap.from('.content-section .content-box', {
                        scrollTrigger: {
                            trigger: '.content-section',
                            start: 'top center',
                            end: 'top top',
                            scrub: 1
                        },
                        y: '25vh',
                        opacity: 0
                    });
                 ">
                <div class="container mx-auto px-8">
                    <div class="content-box max-w-6xl mx-auto bg-neutral-900/80 backdrop-blur-sm text-gray-300 p-8 md:p-12 rounded-2xl shadow-2xl"
                         x-show="show"
                         x-transition:enter="transition ease-out duration-1000"
                         x-transition:enter-start="opacity-0 translate-y-12"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-12">
                        @if(is_array($content) && isset($content[$locale]))
                            <h2 class="text-2xl md:text-6xl text-gray-300 font-bold mb-2">{{ $content[$locale]['title'] }}</h2>
                            <p class="text-2xl md:text-4xl text-primary-500 font-bold mb-6">{{ $content[$locale]['subtitle'] }}</p>

                            <div class="space-y-6">
                                <p class="text-xl md:text-2xl">{{ $content[$locale]['intro'] }}</p>
                                <p class="text-xl md:text-2xl">{{ $content[$locale]['mission'] }}</p>
                                <p class="text-xl md:text-2xl italic">{{ $content[$locale]['closing'] }}</p>
                            </div>
                        @else
                            <div class="prose prose-lg prose-invert">
                                {!! $content !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        <!-- </section> -->

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
                                duration: 200, // Aumentado de 20 a 200 para hacerlo más lento
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
                            additionalY.val = -velocity / 5000; // Reducido de 2000 a 5000 para hacerlo más suave
                            additionalYAnim = gsap.to(additionalY, { val: 0 });
                        }
                        if (velocity < 0) {
                            if (additionalYAnim) additionalYAnim.kill();
                            additionalY.val = -velocity / 5000; // Reducido de 3000 a 5000 para hacerlo más suave
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
