<div class="py-8">
    <h2 class="text-2xl font-bold mb-6 text-white">{{ $translations['our_shows'] }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($shows as $show)
        <div class="bg-neutral-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-white mb-2">{{ $show->getName() }}</h3>
                @if($show->getDescription())
                    <p class="text-gray-400 mb-4">{{ $show->getDescription() }}</p>
                @endif
                <a href="{{ $show->domain ? 
                    route('site.domain.home', ['domain' => $show->domain]) : 
                    route('site.home') }}" 
                   class="inline-block bg-neutral-700 hover:bg-neutral-600 text-white text-sm px-4 py-2 rounded transition">
                    {{ $translations['view_more'] }}
                </a>
            </div>
        </div>
        @endforeach

        @if($shows->isEmpty())
            <p class="text-gray-400">{{ $translations['no_shows'] }}</p>
        @endif
    </div>
</div>
