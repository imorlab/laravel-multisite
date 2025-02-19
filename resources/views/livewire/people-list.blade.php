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
                    <div class="group relative rounded-2xl overflow-hidden cursor-pointer transform-gpu transition-all duration-500 hover:scale-105 flex flex-col h-full">
                        <!-- Contenedor de la imagen -->
                        <div class="relative h-64 overflow-hidden flex-shrink-0">
                            <!-- Imagen -->
                            <div class="absolute inset-0">
                                @if(isset($person['photo']) && $person['photo'])
                                    <img src="{{ $person['photo'] }}" 
                                         alt="{{ $person['name'] ?? '' }}" 
                                         class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                                    >
                                @endif
                            </div>
                            
                            <!-- Overlay gradiente sutil -->
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-tertiary-500/20"></div>
                        </div>

                        <!-- Información debajo de la foto -->
                        <div class="p-4 bg-tertiary-100/10 backdrop-blur-sm transition-all duration-500 flex-1 flex flex-col min-h-[5rem]">
                            <h3 class="text-xl font-bold text-primary-500 group-hover:text-gray-100 transition-colors duration-300 line-clamp-1">
                                {{ $person['name'] ?? '' }}
                            </h3>
                            <p class="text-sm text-primary-100 mt-1 transition-all duration-300 line-clamp-2">
                                {{ $person['role'] ?? '' }}
                            </p>
                            
                            <!-- Línea decorativa -->
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-500 transform origin-left scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Resto del equipo -->
            @if($people->count() > 3)
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                    @foreach($people->skip(3) as $person)
                        <div class="group relative rounded-2xl overflow-hidden cursor-pointer transform-gpu transition-all duration-500 hover:scale-105 flex flex-col h-full">
                            <!-- Contenedor de la imagen -->
                            <div class="relative h-52 overflow-hidden flex-shrink-0">
                                <!-- Imagen -->
                                <div class="absolute inset-0">
                                    @if(isset($person['photo']) && $person['photo'])
                                        <img src="{{ $person['photo'] }}" 
                                             alt="{{ $person['name'] ?? '' }}" 
                                             class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                                        >
                                    @endif
                                </div>
                                
                                <!-- Overlay gradiente sutil -->
                                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-tertiary-500/20"></div>
                            </div>

                            <!-- Información debajo de la foto -->
                            <div class="p-4 bg-tertiary-100/10 backdrop-blur-sm transition-all duration-500 flex-1 flex flex-col min-h-[5rem]">
                                <h3 class="text-xl font-bold text-primary-500 group-hover:text-gray-100 transition-colors duration-300 line-clamp-2">
                                    {{ $person['name'] ?? '' }}
                                </h3>
                                <p class="text-sm text-primary-100 mt-1 transition-all duration-300 line-clamp-2">
                                    {{ $person['role'] ?? '' }}
                                </p>
                                
                                <!-- Línea decorativa -->
                                <div class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-500 transform origin-left scale-x-0 transition-transform duration-500 group-hover:scale-x-100"></div>
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
