@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-16">
        <livewire:people-list :site="$site" :people="$people" :type="$type" />
    </div>
@endsection
