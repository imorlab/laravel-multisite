@php
    $baseRoute = $site->domain ? 'site.domain.staff.show' : 'site.staff.show';
@endphp

<div class="py-8">
    @if($people->isNotEmpty())
        <h2 class="text-4xl font-bold mb-12 text-white text-center">Staff</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($people as $person)
                <div class="group bg-tertiary-400 rounded-xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105">
                    <div class="relative">
                        @if(isset($person['photo']) && $person['photo'])
                            <img src="{{ $person['photo'] }}" 
                                 alt="{{ $person['name'] ?? '' }}" 
                                 class="w-full h-64 object-cover transition-all duration-300 group-hover:scale-110"
                            >
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">{{ $person['name'] ?? '' }}</h3>
                        <p class="text-primary-100">{{ $person['role'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-white">No hay personal disponible</p>
    @endif
</div>
