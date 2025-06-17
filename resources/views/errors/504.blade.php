@extends('layouts.app')

@section('title', 'Gateway Timeout')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-danger">504</h1>
    <h2 class="mb-4">Gateway Timeout</h2>
    <p class="lead">The server did not receive a timely response. Please try again later.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
