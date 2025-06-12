@extends('layouts.dashboard')

@section('title', 'REGISTER WORKER')

@section('content')
    <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Register Worker</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            Worker's Menu / 
                            <li class="breadcrumb-item active"><a href="{{ route('register-worker') }}">Register Worker</a></li>
                        </ol>
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
                    <form method="POST" action="{{ route('validate-worker-otp') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Worker Name</label>
                                <input type="text" class="form-control" id="inputName" name="worker_name" placeholder="Enter Worker Name" value="{{ old('worker_name') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputUAN">UAN</label>
                                <input type="number" class="form-control" id="inputUAN" name="worker_uan" placeholder="Enter UAN" value="{{ old('worker_uan') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDOB">Date of Birth</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" id="inputDOB" name="worker_dob" placeholder="DD-MMM-YYYY" value="{{ old('worker_dob') }}">
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputGender">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderMale">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderFemale">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderOther" value="Other" {{ old('gender') == 'Other' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderOther">Other</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    <!-- /.main-content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(function () { 
            $('#reservationdate').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD-MMM-YYYY'
                }
            }, function(start, end, label) {
                $('#inputDOB').val(start.format('DD-MMM-YYYY'));
            });
        });
    </script>
@endsection

