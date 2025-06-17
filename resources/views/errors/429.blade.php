@extends('layouts.app')

@section('title', 'Too Many Requests')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-danger">429</h1>
    <h2 class="mb-4">Too Many Requests</h2>
    <p class="lead">You are making requests too quickly. Please slow down and try again later.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
