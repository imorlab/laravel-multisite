<div>
<div class="p-8">
    <h2 class="text-4xl font-bold mt-24 text-orange-600">{{ $translations['show_producer'] }}</h2>
    <p class="text-xl text-gray-300 mt-3 ">{{ $translations['description'] }}</p>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-12 my-24">
        @foreach($shows as $show)
        <div data-atropos data-atropos-offset="6" class="atropos-wrap group">
            <div class="atropos-scale">
                <div class="atropos-rotate">
                    <div class="atropos-inner relative h-[400px] rounded-lg shadow-lg shadow-gray-600 overflow-hidden transform-gpu">
                        {{-- Fondo --}}
                        <div class="absolute inset-0" data-atropos-offset="0">
                            <img src="{{ $show->getSiteImage('background.jpg') }}"
                                 alt="Fondo {{ $show->getName() }}"
                                 class="w-full h-full object-cover">
                        </div>

                        {{-- Overlay gradiente --}}
                        <!-- <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent" data-atropos-offset="2"></div> -->

                        {{-- Contenido --}}
                        <div class="relative h-full p-0 flex flex-col justify-between">
                            {{-- Logo en la parte superior --}}
                            <div class="flex justify-center mt-16 mb-0" data-atropos-offset="6">
                                <img src="{{ $show->getSiteImage('logo.png') }}"
                                     alt="Logo {{ $show->getName() }}"
                                     class="h-32 object-fit">
                            </div>

                            {{-- Vidriera en el medio --}}
                            <div class="flex justify-center m-0" data-atropos-offset="4">
                                <img src="{{ $show->getSiteImage('vidriera.png') }}"
                                     alt="Vidriera {{ $show->getName() }}"
                                     class="h-42 object-fit">
                            </div>

                            {{-- Botón en la parte inferior --}}
                            <div data-atropos-offset="6" class="transform-gpu text-center">
                                <a href="{{ $show->domain ?
                                    route('site.domain.home', ['domain' => $show->domain]) :
                                    route('site.home') }}"
                                   class="inline-block relative hover-shine opacity-0 translate-y-12 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                                    <img src="{{ $show->getSiteImage('boton.png') }}"
                                         alt="{{ $translations['view_more'] }}"
                                         class="w-56 object-fit transition-transform duration-300 hover:scale-120 p-1">
                                </a>
                            </div>
                        </div>

                        {{-- Enlace que cubre toda la tarjeta --}}
                        <a href="{{ $show->domain ?
                            route('site.domain.home', ['domain' => $show->domain]) :
                            route('site.home') }}"
                           class="absolute inset-0 z-10">
                            <span class="sr-only">{{ $show->getName() }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @if($shows->isEmpty())
            <p class="text-gray-400">{{ $translations['no_shows'] }}</p>
        @endif
    </div>
</div>

<style>
/* Estilos para el efecto Atropos */
.atrosha {
    position: absolute;
    inset: 0;
    background: inherit;
    filter: blur(40px) saturate(400%);
    z-index: -1;
}
.atropos-wrap {
    transform-style: preserve-3d;
    perspective: 1200px;
}

.atropos-inner {
    transform-style: preserve-3d;
    backface-visibility: hidden;
    transition: all 0.1s ease-out;
}

.atropos-active .atropos-inner {
    transition: none;
}

/* Mejoras visuales */
.atropos-inner {
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: linear-gradient(145deg, rgba(38, 38, 38, 0.9), rgba(23, 23, 23, 0.9));
    backdrop-filter: blur(10px);
}

.atropos-active .atropos-inner {
    box-shadow:
        0 25px 20px -12px rgba(0, 0, 0, 0.5),
        0 10px 20px -6px rgba(255, 255, 255);
}

/* Animaciones */
.atropos-wrap:hover .atropos-inner::after {
    opacity: 1;
}

.atropos-inner::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top,
        rgba(124, 58, 237, 0.1),
        transparent 30%
    );
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

/* Animación del botón */
.group:hover .transform {
    transform: translateY(0) scale(1);
}

.group:hover .transform:hover {
    transform: translateY(-0.25rem) scale(1.05);
}

/* Asegurar que el botón esté por encima del enlace principal */
[data-atropos-offset="8"] {
    z-index: 20;
}

/* Animaciones para las imágenes */
.atropos-inner img {
    transition: transform 0.3s ease;
}

.group:hover .atropos-inner img {
    transform: scale(1.05);
}

/* Efecto de destello */
.hover-shine {
    position: relative;
    overflow: hidden;
}

.hover-shine::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(
        to right,
        transparent 0%,
        rgba(255, 255, 255, 0.3) 50%,
        transparent 100%
    );
    transform: skewX(-25deg);
    transition: left 0.5s ease;
}

.hover-shine:hover::before {
    animation: shine 1s ease-in-out;
}

@keyframes shine {
    0% {
        left: -100%;
    }
    100% {
        left: 200%;
    }
}
</style>
</div>

</div>
