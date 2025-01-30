<div class="mt-12">
    <h2 class="text-2xl font-bold mb-4">{{ $translations['our_shows'] }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($shows as $show)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $show->getName() }}</h3>
                <a href="{{ url($show->domain) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    {{ $translations['view_more'] }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
