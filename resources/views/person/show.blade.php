@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-neutral-800 shadow-lg rounded-lg overflow-hidden">
            @if($person->photo)
                <img src="{{ Storage::url($person->photo) }}" alt="{{ $person->getName() }}" class="w-full h-64 object-cover">
            @endif
            <div class="p-8">
                <h1 class="text-3xl font-bold mb-4 text-gray-200">{{ $person->getName() }}</h1>
                @if($person->type === 'cast')
                    <h2 class="text-xl text-gray-400 mb-6">{{ $person->getCharacterName() }}</h2>
                @else
                    <h2 class="text-xl text-gray-400 mb-6">{{ $person->getRole() }}</h2>
                @endif
                <div class="prose prose-invert max-w-none text-gray-300">
                    {!! $person->getBio() !!}
                </div>
                @if($person->social_media)
                    <div class="mt-6 flex gap-4">
                        @foreach($person->social_media as $platform => $url)
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-gray-200">
                                {{ ucfirst($platform) }}
                            </a>
                        @endforeach
                    </div>
                @endif
                <div class="mt-8">
                    <a href="{{ url()->previous() }}" class="text-gray-400 hover:text-gray-200">
                        ← {{ __('Volver') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
