@php
    $titles = [
        'staff' => __('Staff'),
        'cast' => __('Cast'),
        'creative' => __('Creative Team')
    ];

    $typeUrls = [
        'staff' => 'staff',
        'cast' => 'cast',
        'creative' => 'creative-team'
    ];

    if ($type === 'cast') {
        $baseRoute = $site->domain ? 'site.domain.cast.show' : 'site.cast.show';
    } elseif ($type === 'creative') {
        $baseRoute = $site->domain ? 'site.domain.creative.show' : 'site.creative.show';
    } else {
        $baseRoute = $site->domain ? 'site.domain.staff.show' : 'site.staff.show';
    }
@endphp

<div class="py-8">
    @if($people->isNotEmpty())
        <h2 class="text-4xl font-bold mb-12 text-white text-center">{{ $titles[$type] }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($people as $person)
                <div class="group bg-tertiary-400 rounded-xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105">
                    <div class="relative">
                        @if($person['photo'])
                            <img src="{{ $person['photo'] }}" 
                                 alt="{{ $person['name'] }}" 
                                 class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-64 bg-tertiary-300 flex items-center justify-center">
                                <svg class="w-24 h-24 text-tertiary-100" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-tertiary-500 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-primary-500 transition-colors duration-300">
                            {{ $person['name'] }}
                        </h3>
                        @if($person['role'])
                            <p class="text-gray-300 text-sm mb-3 font-medium">{{ $person['role'] }}</p>
                        @endif
                        @if($person['character_name'])
                            <p class="text-gray-300 text-sm italic">{{ $person['character_name'] }}</p>
                        @endif
                        @php
                            $routeParams = ['slug' => $person['slug']];
                            
                            if ($site->domain) {
                                $routeParams['domain'] = $site->domain;
                            }

                            $url = $site->domain 
                                ? route($baseRoute, $routeParams)
                                : url($typeUrls[$type] . '/' . $person['slug']);
                        @endphp
                        <a href="{{ $url }}" 
                           class="mt-4 inline-block text-primary-500 hover:text-primary-400 font-medium text-sm transition-colors duration-300">
                            {{ __('View Profile') }} →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-400">
            <p>{{ __('No people found.') }}</p>
        </div>
    @endif
</div>
