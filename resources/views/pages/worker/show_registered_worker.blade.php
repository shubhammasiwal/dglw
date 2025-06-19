@extends('layouts.dashboard')

@section('title', 'REGISTERED WORKER | VIEW WORKER DATA')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0">Registered Worker | View Worker Data</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    Registered Worker's Menu /
                    <li class="breadcrumb-item active"><a href="{{ route('registered-workers') }}">Registered Workers</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="row">
                    <!-- Left Side: Photo and Basic Info -->
                    <div class="col-md-4 text-center border-right">
                        <h4 class="border-bottom pb-2 mb-3">Type of Worker: <span class="badge badge-warning">{{ $data['worker_type_label'] }}</span></h4>

                        <img src="{{ $data['photoAsPerEshram'] ? asset('storage/' . $data['photoAsPerEshram']) : asset('images/profile_picture_101.jpg') }}"
                             alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="max-width: 160px;">
                        <h3>{{ $data['name'] }}</h3>
                        <p class="border-bottom pb-2 mb-3">{{ $data['genderLabel'] ?? 'N/A' }}</p>
                    </div>

                    <!-- Right Side: CV Details -->
                    <div class="col-md-8">
                        <h4 class="border-bottom pb-2 mb-3">Personal Details</h4>
                        <div class="row mb-2">
                            <div class="col-sm-6"><strong>UAN:</strong> {{ $worker_uan ?? 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Social Category:</strong> {{ $data['socialCategory'] ?? 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($data['dateOfBirth'])->format('d-M-Y') }}</div>
                        </div>
                        <div class="row mb-2">
                           <div class="col-sm-6"><strong>Marital Status:</strong>
                                {{ $data['maritalStatusLabel'] ?? 'N/A' }}
                            </div>
                            <div class="col-sm-6"><strong>Guardian Name:</strong> {{ $data['guardianname'] ?: 'N/A' }}</div>
                        </div>


                        <h4 class="border-bottom pb-2 mt-4 mb-3">Contact Information</h4>
                        <div class="row mb-2">
                            <div class="col-sm-6"><strong>Email:</strong> {{ $data['email'] ?? 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Mobile:</strong> {{ $data['mobile'] ?? 'N/A' }}</div>
                            @php
                                    $addressDistrictTypeMap = [
                                        '661' => 'Hapur',
                                    ];
                                    $addressStateTypeMap = [
                                        '9' => 'Uttar Pradesh',
                                    ];

                            @endphp
                            <div class="col-sm-6"><strong>Address District:</strong> {{ $addressDistrictTypeMap[$data['addressDistrictCode']] ?? 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Address State:</strong> {{ $addressStateTypeMap[$data['addressStateCode']] ?? 'N/A' }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6"><strong>Aadhar Mobile:</strong> {{ $data['aadharMobile'] ?? 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Eshram Mobile:</strong> {{ $data['eshramMobile'] ?? 'N/A' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6"><strong>Permanent State Name:</strong> {{ $data['permanentStateName'] ?? 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Permanent District Name:</strong> {{ $data['permanentDistrictName'] ?? 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Local State Name:</strong> {{ $data['localStateName'] ?? 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Local District Name:</strong> {{ $data['localDistrictName'] ?? 'N/A' }}</div>
                        </div>

                        <h4 class="border-bottom pb-2 mt-4 mb-3">Occupation Information</h4>
                        <div class="row mb-2">
                            <div class="col-sm-6"><strong>Primary Skill:</strong> {{ $data['primarySkillCode'] ?: 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Occupation:</strong> {{ $data['occupationAsPerEshram'] }}</div>
                        </div>

                        <h4 class="border-bottom pb-2 mt-4 mb-3">Financial Information</h4>
                        <div class="row mb-2">
                            <div class="col-sm-6"><strong>Account Number:</strong> {{ $data['accountNo'] ?: 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Account IFSC Code:</strong> {{ $data['ifscCode'] ?: 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Branch Address:</strong> {{ $data['branchAddress'] ?? 'N/A' }}</div>

                        </div>

                        <h4 class="border-bottom pb-2 mt-4 mb-3">Nominee Information</h4>
                        <div class="row mb-2">
                            <div class="col-sm-6"><strong>Nominee Name:</strong> {{ $data['nomineeName'] ?? 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Nominee DOB:</strong> 
                                {{ !empty($data['nomineeDob']) ? \Carbon\Carbon::parse($data['nomineeDob'])->format('d-M-Y') : 'N/A' }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6"><strong>Relationship:</strong>
                                @php
                                    $relationshipMap = [
                                        '15' => 'Brother',
                                        // Add more if needed
                                    ];
                                @endphp
                                {{ $relationshipMap[$data['relationshipWithNominee']] ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div>
</section>
@endsection
