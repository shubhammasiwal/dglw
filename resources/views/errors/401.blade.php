@extends('layouts.app')

@section('title', 'Unauthorized')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-warning">401</h1>
    <h2 class="mb-4">Unauthorized</h2>
    <p class="lead">You need to log in to access this page.</p>
    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Login</a>
</div>
@endsection
