@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <livewire:show-page :page="$page" />
        <livewire:shows-list />
        <livewire:news-list :site="$site" />
        <livewire:people-list :site="$site" :type="'staff'" />
        <livewire:people-list :site="$site" :type="'cast'" />
        <livewire:people-list :site="$site" :type="'creative'" />
    </div>
</div>
@endsection
