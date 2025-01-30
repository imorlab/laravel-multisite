<div class="mt-12">
    <h2 class="text-2xl font-bold mb-4">{{ __('Últimas Noticias') }}</h2>
    <div class="space-y-6">
        @foreach($news as $newsItem)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $newsItem->getTitle() }}</h3>
                <p class="text-gray-600 mb-4">{{ $newsItem->getExcerpt() }}</p>
                <a href="{{ $site->is_main ? url('news/' . $newsItem->slug) : route('site.news.show', ['domain' => $site->domain, 'slug' => $newsItem->slug]) }}" class="text-blue-600 hover:text-blue-800">
                    {{ __('Leer más') }} →
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
