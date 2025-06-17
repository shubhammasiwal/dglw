@extends('layouts.app')

@section('title', 'Bad Gateway')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-danger">502</h1>
    <h2 class="mb-4">Bad Gateway</h2>
    <p class="lead">The server received an invalid response. Please try again later.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
