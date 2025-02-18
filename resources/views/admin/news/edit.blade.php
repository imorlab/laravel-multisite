@extends('layouts.admin')

@section('content')
<div class="py-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white/10 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-200">{{ __('Edit News') }}</h2>
                    <a href="{{ route('admin.news.index') }}" 
                       class="inline-flex items-center px-3 py-1 border border-gray-700 rounded-md text-sm text-gray-300 hover:bg-gray-700">
                        {{ __('← Back') }}
                    </a>
                </div>

                <form action="{{ route('admin.news.update', $news) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Titles -->
                        <div>
                            <label for="title_es" class="block text-sm font-medium text-gray-300">{{ __('Title (Spanish)') }}</label>
                            <input type="text" name="title_es" id="title_es" 
                                   class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                   value="{{ old('title_es', $news->getTitle('es')) }}" required>
                            @error('title_es')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="title_en" class="block text-sm font-medium text-gray-300">{{ __('Title (English)') }}</label>
                            <input type="text" name="title_en" id="title_en" 
                                   class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                   value="{{ old('title_en', $news->getTitle('en')) }}" required>
                            @error('title_en')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-300">{{ __('Slug') }}</label>
                        <input type="text" name="slug" id="slug" 
                               class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                               value="{{ old('slug', $news->slug) }}" required>
                        @error('slug')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Excerpts -->
                        <div>
                            <label for="excerpt_es" class="block text-sm font-medium text-gray-300">{{ __('Excerpt (Spanish)') }}</label>
                            <textarea name="excerpt_es" id="excerpt_es" rows="2"
                                      class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                      required>{{ old('excerpt_es', $news->getExcerpt('es')) }}</textarea>
                            @error('excerpt_es')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="excerpt_en" class="block text-sm font-medium text-gray-300">{{ __('Excerpt (English)') }}</label>
                            <textarea name="excerpt_en" id="excerpt_en" rows="2"
                                      class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                      required>{{ old('excerpt_en', $news->getExcerpt('en')) }}</textarea>
                            @error('excerpt_en')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <!-- Contents -->
                        <div>
                            <label for="content_es" class="block text-sm font-medium text-gray-300">{{ __('Content (Spanish)') }}</label>
                            <textarea name="content_es" id="content_es" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                      required>{{ old('content_es', $news->getContent('es')) }}</textarea>
                            @error('content_es')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="content_en" class="block text-sm font-medium text-gray-300">{{ __('Content (English)') }}</label>
                            <textarea name="content_en" id="content_en" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                      required>{{ old('content_en', $news->getContent('en')) }}</textarea>
                            @error('content_en')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                        <!-- Published At -->
                        <div>
                            <label for="published_at" class="block text-sm font-medium text-gray-300">{{ __('Publication Date') }}</label>
                            <input type="datetime-local" name="published_at" id="published_at" 
                                   class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                   value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                            @error('published_at')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <!-- Published Status -->
                        <div class="flex items-center justify-end space-x-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_published" id="is_published" 
                                       class="h-4 w-4 rounded border-gray-700 bg-gray-800 text-primary-600 focus:ring-primary-500"
                                       value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }}>
                                <label for="is_published" class="ml-2 text-sm text-gray-300">
                                    {{ __('Publish immediately') }}
                                </label>
                            </div>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Update News') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('title_es').addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endpush
@endsection
