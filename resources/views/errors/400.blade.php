@extends('layouts.app')

@section('title', 'Bad Request')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-danger">400</h1>
    <h2 class="mb-4">Bad Request</h2>
    <p class="lead">Sorry, your request was invalid. Please check your input and try again.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
