@php
    $baseRoute = $site->domain ? 'site.domain.staff.show' : 'site.staff.show';
@endphp

<div class="container mx-auto max-w-6xl py-16 reveal-scroll">
    @if($people->isNotEmpty())
        <h2 class="text-4xl font-bold mb-12 text-white text-center">{{ __('staff.our_staff') }}</h2>
        <div class="space-y-8">
            <!-- Primera fila - 3 personas destacadas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($people->take(3) as $person)
                    <div class="group relative h-64 rounded-2xl overflow-hidden cursor-pointer transform-gpu transition-all duration-500 hover:scale-105">
                        <!-- Imagen de fondo -->
                        <div class="absolute inset-0 bg-gradient-to-b from-tertiary-500/20 to-tertiary-500/90">
                            @if(isset($person['photo']) && $person['photo'])
                                <img src="{{ $person['photo'] }}" 
                                     alt="{{ $person['name'] ?? '' }}" 
                                     class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                                >
                            @endif
                        </div>

                        <!-- Contenido -->
                        <div class="absolute inset-0 flex flex-col justify-end transform transition-all duration-500">
                            <!-- Información -->
                            <div class="transform transition-all duration-500 translate-y-4 group-hover:-translate-y-0">
                                <div class="relative rounded-xl px-3 pt-3 transition-colors duration-300 group-hover:bg-secondary-500/30">
                                    <h3 class="text-2xl font-bold text-primary-500/90 hover:text-gray-100 drop-shadow-lg">
                                        {{ $person['name'] ?? '' }}
                                    </h3>
                                    <p class="text-sm text-primary-100 opacity-0 group-hover:opacity-100 transition-all duration-300 pt-1 pb-3">
                                        {{ $person['role'] ?? '' }}
                                    </p>
                                    
                                    <!-- Línea decorativa -->
                                    <div class="absolute bottom-0 left-0 w-full h-1 bg-primary-500 transform origin-left scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Resto del equipo -->
            @if($people->count() > 3)
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                    @foreach($people->skip(3) as $person)
                        <div class="group relative h-52 rounded-2xl overflow-hidden cursor-pointer transform-gpu transition-all duration-500 hover:scale-105">
                            <!-- Imagen de fondo -->
                            <div class="absolute inset-0 bg-gradient-to-b from-tertiary-500/20 to-tertiary-500/90">
                                @if(isset($person['photo']) && $person['photo'])
                                    <img src="{{ $person['photo'] }}" 
                                         alt="{{ $person['name'] ?? '' }}" 
                                         class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                                    >
                                @endif
                            </div>

                            <!-- Contenido -->
                            <div class="absolute inset-0 flex flex-col justify-end transform transition-all duration-500">
                                <!-- Información -->
                                <div class="transform transition-all duration-500 translate-y-4 group-hover:-translate-y-0">
                                    <div class="relative rounded-xl px-3 pt-3 transition-colors duration-300 group-hover:bg-secondary-500/30">
                                        <h3 class="text-xl font-bold text-primary-500/90 hover:text-gray-100 drop-shadow-lg">
                                            {{ $person['name'] ?? '' }}
                                        </h3>
                                        <p class="text-sm text-primary-100 opacity-0 group-hover:opacity-100 transition-all duration-300 pt-1 pb-3">
                                            {{ $person['role'] ?? '' }}
                                        </p>
                                        
                                        <!-- Línea decorativa -->
                                        <div class="absolute bottom-0 left-0 w-full h-1 bg-primary-500 transform origin-left scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <p class="text-center text-white">No hay personal disponible</p>
    @endif
</div>
