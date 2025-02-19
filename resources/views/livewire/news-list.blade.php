<div>
    <div class="mx-4 my-36 reveal-scroll">
        <h2 class="text-4xl font-bold mb-12 text-gray-100">{{ $translations['latest_news'] }}</h2>

        <div>
            <div class="max-w-7xl mx-auto">
                <x-news-grid :news="$news" />
            </div>
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
</div>
