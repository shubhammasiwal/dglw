@extends('layouts.dashboard')

@section('title', 'WORKER RELATIONSHIP | EDIT')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Worker Relationship | Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('worker-relationship.index') }}">Worker Relationship</a></li>
                        <li class="breadcrumb-item active">Edit Worker Relationship</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="card ">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form method="POST" action="{{ route('worker-relationship.update', $worker_relationship->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputCode">Code</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="inputCode"
                                name="code" placeholder="Enter Code" value="{{ old('code', $worker_relationship->codeDirectory->code) }}">
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName"
                                name="name" placeholder="Enter Name" value="{{ old('name', $worker_relationship->name) }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="inputTableName" name="table_name" placeholder="Enter Category Type" value="{{ $table_name }}" readonly>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.main-content -->
@endsection
