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
@endphp

<div class="py-8">
    @if($people->isNotEmpty())
        <h2 class="text-2xl font-bold mb-6 text-white">{{ $titles[$type] }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($people as $person)
                <div class="bg-neutral-800 rounded-lg shadow-lg overflow-hidden">
                    @if($person['photo'])
                        <img src="{{ $person['photo'] }}" alt="{{ $person['name'] }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-white mb-2">{{ $person['name'] }}</h3>
                        @if($person['role'])
                            <p class="text-gray-400 text-sm mb-4">{{ $person['role'] }}</p>
                        @endif
                        @if($person['character_name'])
                            <p class="text-gray-400 text-sm mb-4">{{ $person['character_name'] }}</p>
                        @endif
                        @php
                            $baseRoute = $site->domain ? 'site.domain.person.show' : 'site.person.show';
                            $routeParams = ['slug' => $person['slug']];
                            
                            if ($site->domain) {
                                $routeParams['domain'] = $site->domain;
                            }

                            $url = $site->domain 
                                ? route($baseRoute, $routeParams)
                                : url($typeUrls[$type] . '/' . $person['slug']);
                        @endphp
                        <a href="{{ $url }}" 
                           class="inline-block bg-neutral-700 hover:bg-neutral-600 text-white text-sm px-4 py-2 rounded transition">
                            {{ __('Ver perfil') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
