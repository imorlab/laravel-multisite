@extends('layouts.app')

@section('content')
<div class="relative md:mt-12">
    <!-- Hero Section -->
    <div class="relative h-[35vh] min-h-[350px] overflow-hidden bg-tertiary-500">
        <div class="absolute inset-0">
            <img src="https://picsum.photos/seed/news/1920/1080" alt="News Background" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/40 to-tertiary-500"></div>

        <div class="absolute bottom-0 md:bottom-10 left-0 right-0">
            <div class="container max-w-8xl mx-auto px-4 py-8">
                <h1 class="text-white text-3xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                    {{ __('news.index.title') }}
                </h1>
                <p class="text-white text-lg md:text-lg lg:text-lg md:font-bold leading-tight mb-4">{{ __('news.index.description') }}</p>
            </div>
        </div>
    </div>

    <!-- News Grid -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-8xl mx-auto">
            <x-news-grid :news="$news" />
        </div>
    </div>
</div>
@endsection
