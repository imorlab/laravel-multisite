<div>
<div class="py-8">
    <h2 class="text-2xl font-bold mb-6 text-white">{{ $translations['our_shows'] }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($shows as $show)
        <div data-atropos data-atropos-offset="6" class="atropos-wrap group">
            <div class="atropos-scale">
                <div class="atropos-rotate">
                    <div class="atropos-inner relative h-[400px] rounded-lg shadow-md overflow-hidden transform-gpu">
                        {{-- Fondo (aquí irá la imagen cuando la tengamos) --}}
                        <div class="absolute inset-0 bg-gradient-to-br from-neutral-800 to-neutral-900" data-atropos-offset="0">
                            {{-- Placeholder para la imagen --}}
                            <div class="w-full h-full flex items-center justify-center text-neutral-700 text-4xl font-bold opacity-20">
                                {{ $show->getName() }}
                            </div>
                        </div>

                        {{-- Overlay gradiente --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent" data-atropos-offset="2"></div>

                        {{-- Contenido --}}
                        <div class="relative h-full p-6 flex flex-col justify-end">
                            <h3 class="text-2xl font-bold text-white mb-3" data-atropos-offset="5">
                                {{ $show->getName() }}
                            </h3>
                            
                            @if($show->getDescription())
                                <p class="text-gray-300 mb-6 line-clamp-3" data-atropos-offset="4">
                                    {{ $show->getDescription() }}
                                </p>
                            @endif
                            
                            <div data-atropos-offset="8" class="transform-gpu text-center">
                                <a href="{{ $show->domain ? 
                                    route('site.domain.home', ['domain' => $show->domain]) : 
                                    route('site.home') }}" 
                                   class="inline-block bg-violet-600/90 hover:bg-violet-600 text-white text-sm px-6 py-2 rounded transition-all duration-300 transform translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto">
                                    {{ $translations['view_more'] }} →
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
        0 25px 50px -12px rgba(0, 0, 0, 0.5),
        0 0 30px -10px rgba(124, 58, 237, 0.5);
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
</style>
</div>