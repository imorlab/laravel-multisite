@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <livewire:show-page :page="$page" />
        <livewire:shows-list />
        <livewire:news-list :site="$site" />
        <livewire:staff-list :site="$site" />
    </div>
</div>
@endsection
