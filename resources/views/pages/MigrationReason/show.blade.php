@extends('layouts.dashboard')

@section('title', 'MIGRATION REASON | SHOW')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Migration Reason | Show</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('migration-reason.index') }}">Migration Reason</a></li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('migration-reason.edit', $migration_reason->id) }}" class="btn btn-primary">Edit</a>
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
                            <h3 class="card-title">Migration Reason Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table class="table table-bordered">
                                <tr>
                                    <th>Label</th>
                                    <td>{{ $migration_reason->_label }}</td>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <td>{{ $migration_reason->codeDirectory->code }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $migration_reason->name }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $migration_reason->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $migration_reason->updated_at }}</td>
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

