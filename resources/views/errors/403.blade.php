@extends('layouts.app') 

@section('title', 'Access Denied')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 text-danger">403</h1>
    <h2 class="mb-4">Access Forbidden</h2>
    <p class="lead">Sorry, you do not have permission to access this page.</p>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Go Back</a>
</div>
@endsection