<div>
    <section class="relative py-24 md:py-8 overflow-hidden reveal-scroll">
        <h2 class="text-4xl font-bold text-gray-100 mb-12">{{ __('welcome.title') }}</h2>
        <div class="relative container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12">
                @foreach($sections as $index => $section)
                <div x-data="{ shown: false }"
                     x-intersect.once="setTimeout(() => shown = true, {{ $index * 350 }})"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                     class="group relative bg-tertiary-100/10 backdrop-blur-sm rounded-2xl p-8 transition-all duration-800 ease-out hover:bg-tertiary-100/20 hover:scale-[1.02] hover:shadow-xl overflow-hidden">
                    <!-- Decorative elements -->
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>

                    <!-- Icon based on section title -->
                    <div class="relative mb-6">
                        <div class="w-16 h-16 rounded-xl bg-primary-500/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            @switch(strtolower($section['title']))
                                @case('producción teatral')
                                @case('theatrical production')
                                    <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    @break
                                @case('servicios integrales')
                                @case('comprehensive services')
                                    <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    @break
                                @case('gestión de espacios culturales')
                                @case('cultural spaces management')
                                    <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    @break
                                @default
                                    <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                    </svg>
                            @endswitch
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="relative">
                        <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-primary-500 transition-colors duration-300">
                            {{ $section['title'] }}
                        </h3>
                        <p class="text-gray-300 leading-relaxed group-hover:text-white transition-colors duration-300">
                            {{ $section['description'] }}
                        </p>
                    </div>

                    <!-- Hover effect line -->
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-primary-500 to-primary-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
