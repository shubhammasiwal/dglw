@extends('layouts.app')

@section('title', 'Service Unavailable')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-warning">503</h1>
    <h2 class="mb-4">Service Unavailable</h2>
    <p class="lead">We are currently down for maintenance. Please check back soon.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
