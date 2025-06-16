@extends('layouts.dashboard')

@section('title', 'SOCIAL CATEGORY | SHOW')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Social Category | Show</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('social-category.index') }}">Social Category</a></li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('social-category.edit', $social_category->id) }}" class="btn btn-primary">Edit</a>
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
                            <h3 class="card-title">Social Category Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table class="table table-bordered">
                                <tr>
                                    <th>Label</th>
                                    <td>{{ $social_category->_label }}</td>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <td>{{ $social_category->codeDirectory->code }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $social_category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $social_category->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $social_category->updated_at }}</td>
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

