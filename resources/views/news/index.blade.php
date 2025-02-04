@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-gray-200 text-4xl font-bold mb-8">{{ __('content.news') }}</h1>

        <div class="space-y-6">
            @foreach($news as $item)
            <div class="bg-gray-700 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-gray-200 text-2xl font-semibold mb-2">{{ $item->getTitle() }}</h2>
                    <p class="text-gray-400 mb-4">{{ $item->getExcerpt() }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('site.news.show', $site->getRouteParams(['slug' => $item->slug])) }}" 
                           class="text-violet-400 hover:text-violet-200">
                            {{ __('content.read_more') }} →
                        </a>
                        <span class="text-gray-400">{{ $item->published_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
            @endforeach

            @if($news->isEmpty())
                <p class="text-gray-500">{{ __('content.no_news') }}</p>
            @endif
        </div>

        <div class="mt-8">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
