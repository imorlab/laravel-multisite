@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ $site->is_main ? route('news') : route('site.news', ['domain' => $site->domain]) }}" 
               class="text-blue-600 hover:text-blue-800">
                ← {{ __('Volver a Noticias') }}
            </a>
        </div>

        <article class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-8">
                <h1 class="text-4xl font-bold mb-4">{{ $news->getTitle() }}</h1>
                
                <div class="text-gray-500 mb-8">
                    {{ $news->published_at->format('d/m/Y') }}
                </div>

                <div class="prose max-w-none">
                    {!! $news->getContent() !!}
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
