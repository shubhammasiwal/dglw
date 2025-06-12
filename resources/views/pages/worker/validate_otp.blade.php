@extends('layouts.dashboard')

@section('title', 'REGISTER WORKER | VALIDATE OTP')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Register Worker | Validate OTP</h1>
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
                <form method="POST" action="{{ route('validating-otp') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Worker Name</label>
                            <input type="readable" class="form-control" id="inputName" name="worker_name" placeholder="Enter Worker Name" value="{{ $worker_name }}">
                        </div>
                        <div class="form-group">
                            <label for="inputUAN">UAN</label>
                            <input type="readable" class="form-control" id="inputUAN" name="worker_uan" placeholder="Enter UAN" value="{{ $worker_uan }}">
                        </div>
                        <div class="form-group">
                            <label for="inputDOB">Date of Birth</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="readable" class="form-control datetimepicker-input" data-target="#reservationdate" id="inputDOB" name="worker_dob" placeholder="DD-MMM-YYYY" value="{{ $worker_dob }}">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputOTP">OTP</label>
                            <input type="number" class="form-control" id="inputOTP" name="worker_otp" placeholder="Enter OTP" value="{{ old('worker_otp') }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="inputMobileNumber" name="worker_mobile_number" placeholder="Enter Mobile Number" value="{{ $worker_mobile_number }}">
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

