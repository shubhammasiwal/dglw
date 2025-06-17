@extends('layouts.dashboard')

@section('title', 'LGD STATE')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LGD State</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('l-g-d-state.index') }}">LGD State</a></li>
                        <li class="breadcrumb-item active">LGD State</li>
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
                <div class="table-responsive">
                    <table id="codeDirectoryTable" class="table table-bordered table-striped table-hover table-sm shadow">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name EN</th>
                                <th>Name Local</th>
                                <th>Type</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($l_g_d_states as $l_g_d_state)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $l_g_d_state->l_g_d_code }}</td>
                                    <td>{{ $l_g_d_state->name_en }}</td>
                                    <td>{{ $l_g_d_state->name_local }}</td>
                                    <td>
                                        @if ($l_g_d_state->type === config('constants.LGD_STATE_TYPES.STATE'))
                                            {{ config('constants.LGD_STATE_TYPES_LABELS.STATE') }}
                                        @elseif ($l_g_d_state->type === config('constants.LGD_STATE_TYPES.UNION_TERRITORY'))
                                            {{ config('constants.LGD_STATE_TYPES_LABELS.UNION_TERRITORY') }}
                                        @else
                                            {{ $l_g_d_state->type }}
                                        @endif
                                    </td>
                                    <td>{{ $l_g_d_state->created_at }}</td>
                                    <td>{{ $l_g_d_state->updated_at }}</td>
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
