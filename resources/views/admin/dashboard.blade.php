@php
    $title = __('Dashboard');
@endphp

@extends('layouts.admin')

@section('content')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-4xl text-gray-100 leading-tight mt-16">
            {{ $title }}
        </h2>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Quick Actions -->
                <div class="bg-white/10 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-300 mb-4">News</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <a href="{{ route('admin.news.create') }}" 
                               class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500">
                                {{ __('Create News') }}
                            </a>
                            <a href="{{ route('admin.news.index') }}" 
                               class="inline-flex items-center justify-center px-4 py-2 bg-secondary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary-500">
                                {{ __('View All News') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection