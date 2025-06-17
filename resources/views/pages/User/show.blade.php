@extends('layouts.dashboard')

@section('title', 'USER | SHOW')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User | Show</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
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
                            <h3 class="card-title">User Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table class="table table-bordered">
                               <tr>
                                   <th>Name</th>
                                   <td>{{ $user->name }}</td>
                               </tr>
                               <tr>
                                   <th>Email</th>
                                   <td>{{ $user->email }}</td>
                               </tr>
                               <tr>
                                   <th>Role</th>
                                   <td>{{ $user->role }}</td>
                               </tr>
                               <tr>
                                   <th>Permission</th>
                                   <td>
                                       @foreach ($user->permissions as $permission)
                                           <span class="badge badge-primary">{{ $permission }}</span>
                                       @endforeach
                                   </td>
                               </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $user->updated_at }}</td>
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

