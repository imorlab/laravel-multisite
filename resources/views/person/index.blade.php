@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <livewire:people-list :site="$site" :people="$people" :type="$type" />
    </div>
@endsection
