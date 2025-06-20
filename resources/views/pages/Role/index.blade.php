@extends('layouts.dashboard')

@section('title', 'ROLES')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
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
                                <th>Code Label</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->role_label }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>{{ $role->updated_at }}</td>
                                    <td><a href="{{ route('roles.permissions', $role->uuid) }}" class="btn btn-primary"><i class="fas fa-user-lock"></i>Assign Permissions</a></td>
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
