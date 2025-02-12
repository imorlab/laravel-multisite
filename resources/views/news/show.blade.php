@extends('layouts.app')

@section('content')
<article class="relative">
    <!-- Hero Section con Parallax -->
    <div class="relative h-[60vh] min-h-[400px] overflow-hidden">
        <div class="absolute inset-0 transform transition-transform duration-700" x-data x-ref="parallax" @scroll.window="$refs.parallax.style.transform = `translateY(${window.scrollY * 0.5}px)`">
            <img src="https://picsum.photos/seed/{{ $news->id }}/1920/1080" 
                 alt="{{ $news->getTitle() }}"
                 class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#24272D] via-[#24272D]/70 to-transparent"></div>
        
        <!-- Contenedor del título -->
        <div class="absolute bottom-0 left-0 right-0">
            <div class="container mx-auto px-4 py-8">
                <div class="max-w-4xl mx-auto">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center space-x-2 text-sm mb-4" aria-label="Breadcrumb">
                        <a href="{{ $site->domain ? route('site.domain.news', ['domain' => $site->domain]) : route('site.news') }}" 
                           class="text-gray-400 hover:text-[#FF7733] transition-colors">
                            {{ __('content.news') }}
                        </a>
                        <span class="text-gray-600">/</span>
                        <span class="text-gray-400 truncate max-w-[200px]">{{ $news->getTitle() }}</span>
                    </nav>
                    
                    <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                        {{ $news->getTitle() }}
                    </h1>
                    
                    <!-- Meta información -->
                    <div class="flex items-center space-x-6 text-gray-400">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $news->published_at->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center" x-data="{ readingTime: Math.ceil(document.querySelector('.article-content')?.textContent.split(' ').length / 200) || 5 }">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span x-text="readingTime + ' min lectura'"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="bg-[#24272D]">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 max-w-7xl mx-auto">
                <!-- Columna Principal -->
                <div class="lg:col-span-2">
                    <div class="prose prose-lg prose-invert max-w-none article-content text-gray-300">
                        {!! $news->getContent() !!}
                    </div>

                    <!-- Compartir en redes sociales -->
                    <div class="mt-12 pt-6 border-t border-gray-700">
                        <h3 class="text-white text-lg font-semibold mb-4">Compartir</h3>
                        <div class="flex space-x-4">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($news->getTitle() . ' ' . request()->url()) }}"
                               target="_blank"
                               class="p-2 rounded-full bg-gray-700 hover:bg-[#FF7733] transition-colors">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->getTitle()) }}" 
                               target="_blank"
                               class="p-2 rounded-full bg-gray-700 hover:bg-[#FF7733] transition-colors">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank"
                               class="p-2 rounded-full bg-gray-700 hover:bg-[#FF7733] transition-colors">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($news->getTitle()) }}" 
                               target="_blank"
                               class="p-2 rounded-full bg-gray-700 hover:bg-[#FF7733] transition-colors">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar con noticias relacionadas -->
                <aside class="lg:col-span-1">
                    <div class="sticky top-24">
                        <h3 class="text-white text-xl font-semibold mb-6">Más Noticias</h3>
                        <div class="space-y-6">
                            @foreach($relatedNews as $related)
                            <a href="{{ route('site.news.show', $site->getRouteParams(['slug' => $related->slug])) }}" 
                               class="group block">
                                <div class="relative h-48 rounded-lg overflow-hidden mb-3">
                                    <img src="https://picsum.photos/seed/{{ $related->id }}/800/600" 
                                         alt="{{ $related->getTitle() }}"
                                         class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                </div>
                                <h4 class="text-white text-lg font-medium group-hover:text-[#FF7733] transition-colors">
                                    {{ $related->getTitle() }}
                                </h4>
                                <p class="text-gray-400 text-sm mt-2">
                                    {{ $related->published_at->format('d/m/Y') }}
                                </p>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <!-- Navegación entre artículos -->
    @if($previousNews || $nextNews)
    <div class="bg-[#222222]">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @if($previousNews)
                    <a href="{{ route('site.news.show', $site->getRouteParams(['slug' => $previousNews->slug])) }}" 
                       class="group flex items-center">
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-[#FF7733] mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <div>
                            <span class="block text-sm text-gray-400">Anterior</span>
                            <span class="block text-white group-hover:text-[#FF7733] font-medium">{{ $previousNews->getTitle() }}</span>
                        </div>
                    </a>
                    @endif

                    @if($nextNews)
                    <a href="{{ route('site.news.show', $site->getRouteParams(['slug' => $nextNews->slug])) }}" 
                       class="group flex items-center justify-end md:justify-end">
                        <div class="text-right">
                            <span class="block text-sm text-gray-400">Siguiente</span>
                            <span class="block text-white group-hover:text-[#FF7733] font-medium">{{ $nextNews->getTitle() }}</span>
                        </div>
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-[#FF7733] ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</article>

@push('styles')
<style>
    .prose {
        --tw-prose-invert-body: #ffffff;
        --tw-prose-invert-headings: #ffffff;
        --tw-prose-invert-links: #FF7733;
        --tw-prose-invert-bold: #ffffff;
        --tw-prose-invert-counters: #9ca3af;
        --tw-prose-invert-bullets: #4b5563;
        --tw-prose-invert-hr: #374151;
        --tw-prose-invert-quotes: #f3f4f6;
        --tw-prose-invert-quote-borders: #374151;
        --tw-prose-invert-captions: #9ca3af;
        --tw-prose-invert-code: #ffffff;
        --tw-prose-invert-pre-code: #d1d5db;
        --tw-prose-invert-pre-bg: rgb(0 0 0 / 50%);
        --tw-prose-invert-th-borders: #4b5563;
        --tw-prose-invert-td-borders: #374151;
    }
</style>
@endpush
@endsection
