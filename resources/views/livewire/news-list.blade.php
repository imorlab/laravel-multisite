<div>
    <div class="mx-4 my-36 reveal-scroll">
        <h2 class="text-4xl font-bold mb-12 text-gray-100">{{ $translations['latest_news'] }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($news as $item)
            <article class="bg-secondary-500 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:-translate-y-1">
                @php
                    $route = app()->getLocale() === 'es' ? 'site.actualidad.show' : 'site.news.show';
                    $slug = $item->getSlug();
                    if (empty($slug)) continue;
                @endphp
                <a href="{{ route($route, ['slug' => $slug]) }}" class="block">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://picsum.photos/seed/{{ $item->id }}/800/600"
                             alt="{{ $item->getTitle() }}"
                             class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="flex items-center text-sm text-gray-300 space-x-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $item->published_at->format('d/m/Y') }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ ceil(str_word_count(strip_tags($item->getContent())) / 200) }} min
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-white mb-3 line-clamp-2 hover:text-primary-500 transition-colors">
                            {{ $item->getTitle() }}
                        </h2>
                        <p class="text-gray-400 line-clamp-3">
                            {{ $item->getExcerpt() }}
                        </p>
                    </div>
                </a>
            </article>
            @endforeach
        </div>

        @if($news->isEmpty())
            <p class="text-center text-gray-500 mt-8">{{ $translations['no_news'] }}</p>
        @endif

        @if($news->hasPages())
            <div class="mt-8">
                {{ $news->links() }}
            </div>
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
