@extends('layouts.chef')
@section('chef')
    <div class="container mx-auto">
        <livewire:chef-dashboard :restaurant-id="auth()->user()->restaurant_id" />

    </div>
@endsection

