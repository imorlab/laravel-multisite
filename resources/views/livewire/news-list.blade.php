<div class="py-8">
    <h2 class="text-2xl font-bold mb-6 text-white">{{ $translations['latest_news'] }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($news as $newsItem)
        <div class="bg-neutral-900 rounded-lg shadow-md overflow-hidden">
            @if($newsItem->image)
                <img src="{{ $newsItem->image }}" alt="{{ $newsItem->title }}" class="w-full h-48 object-cover">
            @endif
            <div class="p-4">
                <h3 class="text-lg font-semibold text-white mb-2">{{ $newsItem->getTitle() }}</h3>
                <p class="text-gray-400 text-sm mb-4">{{ __('content.published_on', ['date' => $newsItem->published_at->format('d/m/Y')]) }}</p>
                <p class="text-gray-300 mb-4">{{ $newsItem->getExcerpt() }}</p>
                <a href="{{ $site->domain ? 
                    route('site.domain.news.show', ['domain' => $site->domain, 'slug' => $newsItem->slug]) : 
                    route('site.news.show', ['slug' => $newsItem->slug]) }}" 
                    class="inline-block bg-neutral-700 hover:bg-neutral-600 text-white text-sm px-4 py-2 rounded transition">
                    {{ $translations['read_more'] }}
                </a>
            </div>
        </div>
        @endforeach

        @if($news->isEmpty())
            <p class="text-gray-400">{{ $translations['no_news'] }}</p>
        @endif
    </div>
</div>
