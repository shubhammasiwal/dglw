@extends('layouts.app')

@section('title', 'Method Not Allowed')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-danger">405</h1>
    <h2 class="mb-4">Method Not Allowed</h2>
    <p class="lead">The request method is not allowed for this page.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
