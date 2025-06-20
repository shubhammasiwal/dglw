@extends('layouts.dashboard')

@section('title', 'REGISTERED WORKERS')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registered Workers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('registered-workers') }}">Registered Workers</a></li>
                        <li class="breadcrumb-item active">Registered Workers</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('register-worker') }}" class="btn btn-primary">Register Worker</a>
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
                                <th>UAN Number</th>
                                <th>Aadhar Name</th>
                                <th>Worker Type</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registered_workers as $registered_worker)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $registered_worker->uan_number }}</td>
                                    <td>{{ $registered_worker->aadhar_name }}</td>
                                    <td>{{ $registered_worker->workerType->codeDirectory->name }}</td>
                                    <td>{{ $registered_worker->created_at }}</td>
                                    <td>{{ $registered_worker->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('show-registered-worker', $registered_worker->id) }}"
                                            title="View">
                                            <i class="nav-icon fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('destroy-registered-worker', $registered_worker->id) }}"
                                            method="POST" class="d-inline">
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
