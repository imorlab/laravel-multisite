<div>
    <div class="">
        <h2 class="text-4xl font-bold mt-24 text-orange-600">{{ $translations['latest_news'] }}</h2>
        {{-- <p class="text-xl text-gray-300 mt-3">{{ $translations['description'] }}</p> --}}

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 my-24">
            @foreach($news as $item)
            <article class="group relative bg-neutral-900 rounded-2xl overflow-hidden transform transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl">
                <!-- Imagen con overlay gradiente -->
                <div class="relative h-64 overflow-hidden">
                    <img src="https://picsum.photos/seed/{{ $loop->index }}/800/600"
                         alt="{{ $item->getTitle() }}"
                         class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                    {{-- <div class="absolute inset-0 bg-gradient-to-t from-neutral-900 via-neutral-900/50 to-transparent"></div> --}}
                </div>

                <!-- Contenido -->
                <div class="relative p-6">
                    <!-- Fecha -->
                    <div class="flex items-center gap-2 text-orange-500 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm">{{ $item->created_at->format('d M, Y') }}</span>
                    </div>

                    <!-- Título -->
                    <h3 class="text-xl font-bold text-white mb-3 line-clamp-2">{{ $item->getTitle() }}</h3>

                    <!-- Extracto -->
                    <p class="text-gray-400 mb-4 line-clamp-3">{{ $item->getExcerpt() }}</p>

                    <!-- Botón Leer más -->
                    <a href="{{ $site->domain ?
                        route('site.domain.news.show', ['domain' => $site->domain, 'slug' => $item->slug]) :
                        route('site.news.show', ['slug' => $item->slug]) }}"
                       class="inline-flex items-center gap-2 text-orange-500 hover:text-orange-400 transition-colors">
                        {{ $translations['read_more'] }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <!-- Decoración -->
                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-orange-500/20 to-transparent transform rotate-45 translate-x-10 -translate-y-10"></div>
            </article>
            @endforeach
        </div>

        @if($news->isEmpty())
            <p class="text-center text-gray-500">{{ $translations['no_news'] }}</p>
        @endif
    </div>


<style>
/* Animación suave para las imágenes */
.group:hover img {
    filter: brightness(1.1);
}

/* Efecto de profundidad */
article {
    box-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
}

/* Animación del botón */
a:hover svg {
    transform: translateX(5px);
    transition: transform 0.3s ease;
}
</style>
</div>
