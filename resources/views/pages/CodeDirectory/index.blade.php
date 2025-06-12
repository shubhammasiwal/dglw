@extends('layouts.dashboard')

@section('title', 'CODE DIRECTORY')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Code Directory</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('code-directory.index') }}">Directory Code</a></li>
                        <li class="breadcrumb-item active">Directory Code</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('code-directory.create') }}" class="btn btn-primary">Create Code Directory</a>
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
                <div class="table-responsive">
                    <table id="codeDirectoryTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Category Type</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($code_directories as $code_directory)
                                @if ($code_directory)
                                    <tr>
                                        <td>{{ $code_directory->id }}</td>
                                        <td>{{ $code_directory->code }}</td>
                                        <td>{{ $code_directory->name }}</td>
                                        <td>{{ $code_directory->table_name }}</td>
                                        <td>{{ $code_directory->created_at }}</td>
                                        <td>{{ $code_directory->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('code-directory.show', $code_directory->id) }}"
                                                title="View">
                                                <i class="nav-icon fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('code-directory.edit', $code_directory->id) }}"
                                                title="Edit">
                                                <i class="nav-icon fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('code-directory.destroy', $code_directory->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Delete"
                                                    onclick="return confirm('Are you sure?')"
                                                    style="color: red; border: none; background: transparent;">
                                                    <i class="nav-icon fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </section>
    <!-- /.main-content -->
@endsection
