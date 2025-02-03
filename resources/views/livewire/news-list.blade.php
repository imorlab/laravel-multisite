<div class="mt-12">
    <h2 class="text-gray-200 text-2xl font-bold mb-4">{{ __('Últimas Noticias') }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($news as $newsItem)
        <div class="bg-neutral-900 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h3 class="text-gray-200 text-xl font-semibold mb-2">{{ $newsItem->getTitle() }}</h3>
                <p class="text-gray-400 mb-4">{{ $newsItem->getExcerpt() }}</p>
                <a href="{{ $site->domain ? 
                    route('site.domain.news.show', ['domain' => $site->domain, 'slug' => $newsItem->slug]) : 
                    route('site.news.show', ['slug' => $newsItem->slug]) }}" 
                    class="text-blue-600 hover:text-blue-800">
                    {{ __('Leer más') }} →
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
