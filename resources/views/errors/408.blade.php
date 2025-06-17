@extends('layouts.app')

@section('title', 'Request Timeout')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-danger">408</h1>
    <h2 class="mb-4">Request Timeout</h2>
    <p class="lead">The server timed out waiting for your request. Please try again.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
