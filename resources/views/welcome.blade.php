@extends('layouts.app')

@section('content')
<livewire:show-page :page="$page" />
<div class="container mx-auto py-4">
    <div class="w-full mx-auto">
        <livewire:shows-list />
        <livewire:news-list :site="$site" />
        
    </div>
</div>
@endsection
