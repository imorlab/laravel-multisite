@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $staff->getName() }}</h1>
                <h2 class="text-xl text-gray-600 mb-6">{{ $staff->getRole() }}</h2>
                <div class="prose max-w-none">
                    {!! $staff->getBio() !!}
                </div>
                <div class="mt-8">
                    <a href="{{ url()->previous() }}" class="text-blue-600 hover:text-blue-800">
                        ← {{ __('Volver') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
