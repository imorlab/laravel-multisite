@extends('layouts.app')

@section('content')
<article class="relative md:mt-12">
    <!-- Hero Section -->
    <div class="relative h-[40vh] min-h-[400px] overflow-hidden bg-tertiary-500">
        <div class="relative h-full w-full">
            <!-- Hero Image -->
            <div class="absolute inset-0">
                <img src="{{ asset('img/pages/la-productora-hero.jpg') }}" alt="beon. Entertainment" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/40 to-tertiary-500"></div>
            </div>
            
            <!-- Hero Content -->
            <div class="absolute inset-0 flex items-center">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl">
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6">
                            {{ __('producer.title') }}
                        </h1>
                        <p class="text-xl md:text-3xl lg:text-4xl text-gray-300 mb-8">
                            {{ __('producer.subtitle') }}
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-tertiary-500 py-16">
        <div class="container mx-auto px-4">
            <!-- About Section -->
            <div class="container mx-auto mb-16">
                <p class="text-4xl md:text-5xl text-primary-500 font-semibold mb-6">
                    {{ __('producer.tagline') }}
                </p>    
                <p class="text-xl md:text-2xl text-gray-300">
                    {{ __('producer.about') }}
                </p>
            </div>

            <!-- Productions Timeline -->
            <div class="container mx-auto mb-16">
                <div class="space-y-16">
                    <!-- El Médico -->
                    <div class="bg-tertiary-100/10 rounded-lg overflow-hidden">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="aspect-w-16 aspect-h-9 lg:aspect-none lg:h-full">
                                <img src="{{ asset('img/pages/el-medico.jpg') }}" alt="{{ __('producer.el_medico.title') }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-8">
                                <h3 class="text-3xl font-bold text-white mb-4">{{ __('producer.el_medico.title') }}</h3>
                                <div class="prose prose-lg prose-invert">
                                    <p>{{ __('producer.el_medico.description') }}</p>
                                    <ul>
                                        @foreach(__('producer.el_medico.achievements') as $achievement)
                                            <li>{{ $achievement }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- El Tiempo entre Costuras -->
                    <div class="bg-tertiary-100/10 rounded-lg overflow-hidden">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="p-8">
                                <h3 class="text-3xl font-bold text-white mb-4">{{ __('producer.el_tiempo_entre_costuras.title') }}</h3>
                                <div class="prose prose-lg prose-invert">
                                    <p>{{ __('producer.el_tiempo_entre_costuras.description') }}</p>
                                    <ul>
                                        @foreach(__('producer.el_tiempo_entre_costuras.achievements') as $achievement)
                                            <li>{{ $achievement }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="aspect-w-16 aspect-h-9 lg:aspect-none lg:h-full">
                                <img src="{{ asset('img/pages/el-tiempo-entre-costuras.jpg') }}" alt="{{ __('producer.el_tiempo_entre_costuras.title') }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>

                    <!-- La Historia Interminable -->
                    <div class="bg-tertiary-100/10 rounded-lg overflow-hidden">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="aspect-w-16 aspect-h-9 lg:aspect-none lg:h-full">
                                <img src="{{ asset('img/pages/la-historia-interminable.jpg') }}" alt="{{ __('producer.la_historia_interminable.title') }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-8">
                                <h3 class="text-3xl font-bold text-white mb-4">{{ __('producer.la_historia_interminable.title') }}</h3>
                                <div class="prose prose-lg prose-invert">
                                    <p>{{ __('producer.la_historia_interminable.description') }}</p>
                                    <ul>
                                        @foreach(__('producer.la_historia_interminable.achievements') as $achievement)
                                            <li>{{ $achievement }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Forever Van Gogh -->
                    <div class="bg-tertiary-100/10 rounded-lg overflow-hidden">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="p-8">
                                <h3 class="text-3xl font-bold text-white mb-4">{{ __('producer.forever_van_gogh.title') }}</h3>
                                <div class="prose prose-lg prose-invert">
                                    <p>{{ __('producer.forever_van_gogh.description') }}</p>
                                    <ul>
                                        @foreach(__('producer.forever_van_gogh.features') as $feature)
                                            <li>{{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="aspect-w-16 aspect-h-9 lg:aspect-none lg:h-full">
                                <img src="{{ asset('img/pages/van-gogh.jpg') }}" alt="{{ __('producer.forever_van_gogh.title') }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Projects -->
            <div class="max-w-5xl mx-auto mb-16">
                <h2 class="text-4xl font-bold text-white mb-8 text-center">{{ __('producer.upcoming_releases') }}</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Los Pilares de la Tierra -->
                    <div class="bg-tertiary-100/10 rounded-lg p-8">
                        <h3 class="text-2xl font-bold text-white mb-4">{{ __('producer.los_pilares.title') }}</h3>
                        <div class="prose prose-lg prose-invert">
                            <p>{{ __('producer.los_pilares.description') }}</p>
                            <ul>
                                @foreach(__('producer.los_pilares.features') as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Mozart Desatado y Patria -->
                    <div class="space-y-8">
                        <div class="bg-tertiary-100/10 rounded-lg p-8">
                            <h3 class="text-2xl font-bold text-white mb-4">{{ __('producer.mozart.title') }}</h3>
                            <div class="prose prose-lg prose-invert">
                                <p>{{ __('producer.mozart.description') }}</p>
                            </div>
                        </div>

                        <div class="bg-tertiary-100/10 rounded-lg p-8">
                            <h3 class="text-2xl font-bold text-white mb-4">{{ __('producer.patria.title') }}</h3>
                            <div class="prose prose-lg prose-invert">
                                <p>{{ __('producer.patria.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Awards Section -->
            <div class="max-w-4xl mx-auto bg-tertiary-100/10 rounded-lg p-8">
                <h2 class="text-3xl font-bold text-white mb-6 text-center">{{ __('producer.recent_awards') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary-500 p-2 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold mb-2">{{ __('producer.awards.talia.title') }}</h3>
                            <p class="text-gray-300">{{ __('producer.awards.talia.description') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary-500 p-2 rounded-full">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold mb-2">{{ __('producer.awards.musical_theatre.title') }}</h3>
                            <p class="text-gray-300">{{ __('producer.awards.musical_theatre.description') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff Section -->
            <section class="bg-tertiary-500 py-16">
                <div class="container mx-auto px-4">
                    <livewire:people-list :site="$site" type="staff" :staff-list="$staff" />
                </div>
            </section>
        </div>
    </div>
</article>

@push('styles')
<style>
    .prose {
        max-width: none;
    }
    .prose p {
        margin-bottom: 1.5em;
    }
    .lead {
        font-size: 1.25rem;
        line-height: 1.75;
    }
</style>
@endpush
@endsection
