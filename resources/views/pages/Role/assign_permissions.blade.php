@extends('layouts.dashboard')

@section('title', 'ROLE | ASSIGN PERMISSION')

@push('styles')
    <style>
        .select2-container .select2-selection--multiple {
            min-height: 38px;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
        .select2-selection__choice {
            background-color: #007BFF !important;
        }
        .select2-selection__choice__remove {
            color: #0069d9 !important;
        }
    </style>
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Role | Assign Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                        <li class="breadcrumb-item active">Assign Permission</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('store-role-permissions') }}">
                    @csrf
                    <div class="card-body">

                        {{-- Name field --}}
                        <div class="form-group mb-3">
                            <label for="inputName">Role: {{ $role->role_label }}</label>
                            <input type="hidden" class="form-control" name="role_id" value="{{ $role->uuid }}">
                        </div>

                        {{-- Permissions --}}
                        <div class="form-group mb-3">
                            <label for="permissions">Permissions</label>
                            <div class="d-flex justify-content-end mb-2">
                                <button type="button" class="btn btn-sm btn-outline-primary me-2" id="select-all">Select
                                    All</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="deselect-all">Deselect
                                    All</button>
                            </div>
                            <select
                                class="form-select multiple-permission-select @error('permissions') is-invalid @enderror"
                                name="permissions[]" multiple="multiple">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->uuid }}" {{ in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'selected' : '' }}>{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            @error('permissions')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- /.main-content -->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            let $select = $('.multiple-permission-select');

            // Initialize Select2
            $select.select2({
                placeholder: "Select permissions",
                width: '100%',
            });

            // Select All
            $('#select-all').click(function() {
                let allValues = [];
                $select.find('option').each(function() {
                    allValues.push($(this).val());
                });
                $select.val(allValues).trigger('change');
            });

            // Deselect All
            $('#deselect-all').click(function() {
                $select.val([]).trigger('change');
            });
        });
    </script>
@endpush
