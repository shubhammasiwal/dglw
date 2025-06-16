@extends('layouts.dashboard')

@section('title', 'WORKER TYPE | SHOW')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Worker Type | Show</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('worker-type.index') }}">Worker Type</a></li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('worker-type.edit', $worker_type->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Worker Type Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table class="table table-bordered">
                                <tr>
                                    <th>Label</th>
                                    <td>{{ $worker_type->_label }}</td>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <td>{{ $worker_type->codeDirectory->code }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $worker_type->name }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $worker_type->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $worker_type->updated_at }}</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

