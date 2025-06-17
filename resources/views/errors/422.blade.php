@extends('layouts.app')

@section('title', 'Unprocessable Entity')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-warning">422</h1>
    <h2 class="mb-4">Unprocessable Entity</h2>
    <p class="lead">There was a problem with your input. Please check and try again.</p>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
</div>
@endsection
