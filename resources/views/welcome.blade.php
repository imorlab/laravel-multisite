@extends('layouts.app')

@section('content')
<livewire:show-page :page="$page" />
<div class="container mx-auto py-4">
    <div class="w-full mx-auto">
        <div class="mt-8">
            <livewire:shows-list />
        </div>
        
        <div class="mt-8">
            <livewire:services-sections :content="$page->content ?? null" />
        </div>
        
        <div class="mt-8">
            <livewire:news-list :site="$site" />
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @livewireScripts
@endpush

@push('styles')
    @livewireStyles
@endpush