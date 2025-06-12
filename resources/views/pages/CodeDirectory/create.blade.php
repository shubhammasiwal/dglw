@extends('layouts.dashboard')

@section('title', 'CODE DIRECTORY | CREATE')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Code Directory | Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('code-directory.index') }}">Directory Code</a></li>
                        <li class="breadcrumb-item active">Create Directory Code</li>
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
                    <form method="POST" action="{{ route('code-directory.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputCode">Code</label>
                                <input type="text" class="form-control" id="inputCode" name="code" placeholder="Enter Code" value="{{ old('code') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputTableName">Category Type</label>
                                <select class="form-control" id="inputTableName" name="table_name">
                                    <option value="">Select Category Type</option>
                                    @foreach ($tables as $key => $table)
                                        <option value="{{ $key }}" {{ old('table_name') == $key ? 'selected' : '' }}>{{ $table }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    <!-- /.main-content -->
@endsection
