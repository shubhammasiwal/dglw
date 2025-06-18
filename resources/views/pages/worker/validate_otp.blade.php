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
                            <label for="inputUAN">UAN</label>
                            <input type="readable" class="form-control @error('worker_uan') is-invalid @enderror" id="inputUAN" name="worker_uan" placeholder="Enter UAN" value="{{ old('worker_uan', $worker_uan ?? '') }}">
                            @error('worker_uan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputDOB">Date of Birth</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="readable"
                                    class="form-control datetimepicker-input @error('worker_dob') is-invalid @enderror"
                                    data-target="#reservationdate" id="inputDOB" name="worker_dob"
                                    placeholder="DD-MMM-YYYY" value="{{ old('worker_dob', $worker_dob ?? '') }}">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('worker_dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputOTP">OTP</label>
                            <input type="number" class="form-control @error('worker_otp') is-invalid @enderror"
                                id="inputOTP" name="worker_otp" placeholder="Enter OTP" value="{{ old('worker_otp') }}">
                            @error('worker_otp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control @error('worker_mobile_number') is-invalid @enderror"
                                id="inputMobileNumber" name="worker_mobile_number" placeholder="Enter Mobile Number"
                                value="{{ old('worker_mobile_number', $worker_mobile_number ?? '') }}">
                            @error('worker_mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="tookConsent" name="took_consent" required>
                                <label class="form-check-label" for="tookConsent">
                                    Please check this box to give consent
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="submitBtn">Submit OTP</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    $(function() {
        $('#submitBtn').prop('disabled', true);

        $('#tookConsent').on('change', function() {
            $('#submitBtn').prop('disabled', !this.checked);
        });

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
