@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-8">{{ __('Noticias') }}</h1>

        <div class="space-y-6">
            @foreach($news as $item)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-2">{{ $item->getTitle() }}</h2>
                    <p class="text-gray-600 mb-4">{{ $item->getExcerpt() }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ $site->is_main ? route('news.show', $item->slug) : route('site.news.show', ['domain' => $site->domain, 'slug' => $item->slug]) }}" 
                           class="text-blue-600 hover:text-blue-800">
                            {{ __('Leer más') }} →
                        </a>
                        <span class="text-gray-500">{{ $item->published_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
