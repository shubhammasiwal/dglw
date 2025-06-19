@extends('layouts.app')

@section('title', 'Page Expired')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-warning">419</h1>
    <h2 class="mb-4">Page Expired</h2>
    <p class="lead">Your session has expired. Please log in and try again.</p>
    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Login</a>
</div>
@endsection
