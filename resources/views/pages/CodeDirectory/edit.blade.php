@extends('layouts.dashboard')

@section('title', 'CODE DIRECTORY | EDIT')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Code Directory | Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('code-directory.index') }}">Directory Code</a></li>
                        <li class="breadcrumb-item active">Edit Directory Code</li>
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
                    <form method="POST" action="{{ route('code-directory.update', $code_directory->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputCode">Code</label>
                                <input type="text" class="form-control" id="inputCode" name="code" placeholder="Enter Code" value="{{ $code_directory->code }}">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter Name" value="{{ $code_directory->name }}">
                            </div>
                            <div class="form-group">
                                <label for="inputTableName">Category Type</label>
                                <input type="text" class="form-control" id="inputTableName" placeholder="Enter Category Type" value="{{ $code_directory->table_name_label }}" readonly>
                                <input type="hidden" class="form-control" id="inputTableName" name="table_name" placeholder="Enter Category Type" value="{{ $code_directory->table_name }}" readonly>
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

