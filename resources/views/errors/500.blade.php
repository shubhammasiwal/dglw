@extends('layouts.app')

@section('title', 'Server Error')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-danger">500</h1>
    <h2 class="mb-4">Server Error</h2>
    <p class="lead">Oops! Something went wrong on our end. Please try again later.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
