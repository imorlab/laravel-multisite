@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ $site->domain ? 
                route('site.domain.news', ['domain' => $site->domain]) : 
                route('site.news') }}" 
               class="text-violet-600 hover:text-violet-800 mb-4 inline-block">
                ← {{ trans('content.back') }}
            </a>
        </div>

        <article class="bg-gray-700 shadow-lg rounded-lg overflow-hidden">
            <div class="p-8">
                <h1 class="text-gray-200 text-4xl font-bold mb-4">{{ $news->getTitle() }}</h1>
                
                <div class="text-gray-400 mb-8">
                    {{ $news->published_at->format('d/m/Y') }}
                </div>

                <div class="text-gray-300 prose max-w-none">
                    {!! $news->getContent() !!}
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
