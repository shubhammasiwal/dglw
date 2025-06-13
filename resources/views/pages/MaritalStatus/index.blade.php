@extends('layouts.dashboard')

@section('title', 'MARITAL STATUS')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Marital Status</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('marital-status.index') }}">Marital Status</a></li>
                        <li class="breadcrumb-item active">Marital Status</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('marital-status.create') }}" class="btn btn-primary">Create Marital Status</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card ">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="codeDirectoryTable" class="table table-bordered table-striped table-hover table-sm shadow">
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
                            @foreach ($marital_statuses as $marital_status)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $marital_status->codeDirectory->code }}</td>
                                    <td>{{ $marital_status->codeDirectory->name }}</td>
                                    <td>{{ $marital_status->table_name_label }}</td>
                                    <td>{{ $marital_status->created_at }}</td>
                                    <td>{{ $marital_status->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('marital-status.show', $marital_status->id) }}"
                                            title="View">
                                            <i class="nav-icon fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('marital-status.edit', $marital_status->id) }}"
                                            title="Edit">
                                            <i class="nav-icon fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('marital-status.destroy', $marital_status->id) }}"
                                            method="POST">
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
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </section>
    <!-- /.main-content -->
@endsection
@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
    <!-- jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#codeDirectoryTable').DataTable({
                responsive: true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": -1
                }]
            });
        });
    </script>
@endpush
