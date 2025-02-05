@extends('layouts.app')

@section('content')
<livewire:show-page :page="$page" />
<div class="container mx-auto py-4">
    <div class="w-full mx-auto">
        <livewire:shows-list />
        <livewire:news-list :site="$site" />
        <livewire:people-list :site="$site" :type="'staff'" />
        <livewire:people-list :site="$site" :type="'cast'" />
        <livewire:people-list :site="$site" :type="'creative'" />
    </div>
</div>
@endsection
