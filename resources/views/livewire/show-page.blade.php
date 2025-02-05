<div>
    @if($site->is_main)
        <!-- Hero Section -->
        <section class="h-screen sticky top-0 overflow-hidden">
            <h1 class="absolute inset-0 grid place-items-center text-white text-[clamp(3vw,2rem,4rem)] font-extrabold mix-blend-difference pointer-events-none z-50">
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
        <section class="relative bg-gray-900 py-24">
            <div class="container mx-auto px-4">
                <div class="prose prose-lg prose-invert max-w-none">
                    {!! $content !!}
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