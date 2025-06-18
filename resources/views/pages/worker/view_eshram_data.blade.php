@extends('layouts.dashboard')

@section('title', 'REGISTER WORKER | VIEW ESHRAM DATA')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0">Register Worker | View Eshram Data</h1>
            </div>
            <div class="col-sm-6 text-sm-right">
                <a href="{{ route('register-worker') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back to Register Worker
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container">
        <div class="card card-primary card-outline shadow">
            <div class="card-body">
                <div class="row">
                    <!-- Profile Picture -->
                    <div class="col-md-4 text-center">
                        <img src="{{ $data['photoAsPerEshram'] ? asset('storage/' . $data['photoAsPerEshram']) : asset('images/profile_picture_101.jpg') }}"
                             alt="Profile Picture" class="img-fluid img-circle mb-3" style="max-width: 180px;">
                        <h4>{{ $data['name'] }}</h4>
                        <p class="text-muted">{{ $data['genderCode'] == 'M' ? 'Male' : 'Female' }}</p>
                    </div>

                    <!-- Profile Details -->
                    <div class="col-md-8">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <strong><i class="fas fa-id-badge mr-1"></i> UAN</strong>
                                <p>{{ $worker_uan ?? 'N/A' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <strong><i class="fas fa-phone mr-1"></i> Mobile</strong>
                                <p>{{ $data['mobile'] }}</p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                                <p>{{ $data['email'] ?? 'N/A' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <strong><i class="fas fa-birthday-cake mr-1"></i> Date of Birth</strong>
                                <p>{{ \Carbon\Carbon::parse($data['dateOfBirth'])->format('d-M-Y') }}</p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <strong><i class="fas fa-venus-mars mr-1"></i> Gender</strong>
                                <p>{{ $data['genderCode'] == 'M' ? 'Male' : 'Female' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <strong><i class="fas fa-users mr-1"></i> Social Category</strong>
                                <p>{{ $data['socialCategory'] ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <strong><i class="fas fa-ring mr-1"></i> Marital Status</strong>
                                <p>
                                    @php
                                        $maritalStatusMap = ['1' => 'Single', '2' => 'Married', '3' => 'Divorced', '4' => 'Widowed'];
                                    @endphp
                                    {{ $maritalStatusMap[$data['maritalStatusCode']] ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <strong><i class="fas fa-user-friends mr-1"></i> Nominee Name</strong>
                                <p>{{ $data['nomineeName'] ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <strong><i class="fas fa-calendar-alt mr-1"></i> Nominee DOB</strong>
                                <p>{{ !empty($data['nomineeDob']) ? \Carbon\Carbon::parse($data['nomineeDob'])->format('d-M-Y') : 'N/A' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <strong><i class="fas fa-handshake mr-1"></i> Relationship with Nominee</strong>
                                <p>
                                    @php
                                        $relationshipMap = [
                                            '15' => 'Brother',
                                            // add other codes if available
                                        ];
                                    @endphp
                                    {{ $relationshipMap[$data['relationshipWithNominee']] ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <strong><i class="fas fa-tools mr-1"></i> Primary Skill</strong>
                                <p>{{ $data['primarySkillCode'] ?: 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div>
</section>
@endsection
