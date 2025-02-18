@extends('layouts.admin')

@section('content')
<div class="py-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white/10 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-200">{{ __('Create News') }}</h2>
                    <a href="{{ route('admin.news.index') }}" 
                       class="inline-flex items-center px-3 py-1 border border-gray-700 rounded-md text-sm text-gray-300 hover:bg-gray-700">
                        {{ __('← Back') }}
                    </a>
                </div>

                <form action="{{ route('admin.news.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Titles -->
                        <div>
                            <label for="title_es" class="block text-sm font-medium text-gray-300">{{ __('Title (Spanish)') }}</label>
                            <input type="text" name="title_es" id="title_es" 
                                   class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                   value="{{ old('title_es') }}" required>
                            @error('title_es')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="title_en" class="block text-sm font-medium text-gray-300">{{ __('Title (English)') }}</label>
                            <input type="text" name="title_en" id="title_en" 
                                   class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                   value="{{ old('title_en') }}" required>
                            @error('title_en')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-300">{{ __('Slug') }}</label>
                        <input type="text" name="slug" id="slug" 
                               class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                               value="{{ old('slug') }}" required>
                        @error('slug')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Excerpts -->
                        <div>
                            <label for="excerpt_es" class="block text-sm font-medium text-gray-300">{{ __('Excerpt (Spanish)') }}</label>
                            <textarea name="excerpt_es" id="excerpt_es" rows="2"
                                      class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                      required>{{ old('excerpt_es') }}</textarea>
                            @error('excerpt_es')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="excerpt_en" class="block text-sm font-medium text-gray-300">{{ __('Excerpt (English)') }}</label>
                            <textarea name="excerpt_en" id="excerpt_en" rows="2"
                                      class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                      required>{{ old('excerpt_en') }}</textarea>
                            @error('excerpt_en')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <!-- Contents -->
                        <div>
                            <label for="content_es" class="block text-sm font-medium text-gray-300">{{ __('Content (Spanish)') }}</label>
                            <textarea name="content_es" id="content_es" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                      required>{{ old('content_es') }}</textarea>
                            @error('content_es')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="content_en" class="block text-sm font-medium text-gray-300">{{ __('Content (English)') }}</label>
                            <textarea name="content_en" id="content_en" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                      required>{{ old('content_en') }}</textarea>
                            @error('content_en')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                        <!-- Publication Status -->
                        <div class="space-y-4">
                            <div>
                                <label for="publication_status" class="block text-sm font-medium text-gray-300">{{ __('Publication Status') }}</label>
                                <select name="publication_status" id="publication_status" 
                                        class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                    <option value="draft" {{ old('publication_status', 'draft') == 'draft' ? 'selected' : '' }}>{{ __('Save as Draft') }}</option>
                                    <option value="publish_now" {{ old('publication_status') == 'publish_now' ? 'selected' : '' }}>{{ __('Publish Immediately') }}</option>
                                    <option value="schedule" {{ old('publication_status') == 'schedule' ? 'selected' : '' }}>{{ __('Schedule Publication') }}</option>
                                </select>
                            </div>

                            <!-- Published At -->
                            <div id="published_at_container" class="{{ old('publication_status') == 'schedule' ? '' : 'hidden' }}">
                                <label for="published_at" class="block text-sm font-medium text-gray-300">{{ __('Publication Date') }}</label>
                                <input type="datetime-local" name="published_at" id="published_at" 
                                       class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                       value="{{ old('published_at', now()->addHour()->format('Y-m-d\TH:i')) }}"
                                       min="{{ now()->format('Y-m-d\TH:i') }}">
                                @error('published_at')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="flex justify-end items-start">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Create News') }}
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
    // Slug generation
    document.getElementById('title_es').addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-');
        document.getElementById('slug').value = slug;
    });

    // Excerpt generation
    document.getElementById('content_es').addEventListener('input', function() {
        const content = this.value;
        // Get first 150 characters and cut at the last complete word
        let excerpt = content.substring(0, 150).split(' ').slice(0, -1).join(' ');
        
        // Add ellipsis if we actually truncated the content
        if (content.length > 150) {
            excerpt += '...';
        }
        
        document.getElementById('excerpt_es').value = excerpt;
        
        // If auto-translation is enabled, also translate the excerpt
        const translateButton = document.querySelector('[data-field="excerpt"]');
        if (translateButton) {
            translateButton.click();
        }
    });

    // Auto-translation functionality
    async function translateText(text, type) {
        try {
            const response = await fetch('{{ route('admin.news.translate') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ text, type })
            });

            const data = await response.json();
            return data.translation;
        } catch (error) {
            console.error('Translation error:', error);
            return '';
        }
    }

    // Add translation buttons
    function addTranslateButton(spanishId, englishId, type) {
        const spanishInput = document.getElementById(spanishId);
        const englishInput = document.getElementById(englishId);
        
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'absolute right-2 top-2 p-1 text-xs bg-primary-600 text-white rounded hover:bg-primary-500';
        button.innerHTML = '🔄';
        button.title = 'Traducir al inglés';
        button.dataset.field = type;
        
        spanishInput.parentElement.style.position = 'relative';
        spanishInput.parentElement.appendChild(button);

        button.addEventListener('click', async (e) => {
            e.preventDefault();
            const spanishText = spanishInput.value;
            if (!spanishText) return;

            button.disabled = true;
            button.innerHTML = '⏳';
            
            const translation = await translateText(spanishText, type);
            if (translation) {
                englishInput.value = translation;
            }
            
            button.disabled = false;
            button.innerHTML = '🔄';
        });
    }

    // Initialize translation buttons
    document.addEventListener('DOMContentLoaded', () => {
        addTranslateButton('title_es', 'title_en', 'title');
        addTranslateButton('excerpt_es', 'excerpt_en', 'excerpt');
        addTranslateButton('content_es', 'content_en', 'content');
    });

    // Publication status handling
    document.getElementById('publication_status').addEventListener('change', function() {
        const publishedAtContainer = document.getElementById('published_at_container');
        const publishedAtInput = document.getElementById('published_at');
        
        if (this.value === 'schedule') {
            publishedAtContainer.classList.remove('hidden');
            publishedAtInput.required = true;
        } else {
            publishedAtContainer.classList.add('hidden');
            publishedAtInput.required = false;
        }
    });
</script>
@endpush
@endsection
