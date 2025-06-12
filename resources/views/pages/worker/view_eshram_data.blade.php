@extends('layouts.dashboard')

@section('title', 'REGISTER WORKER | VIEW ESHRAM DATA')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Register Worker | View Eshram Data</h1>
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
            <form action="{{ route('post-eshram-data') }}" method="post">
                @csrf
                <div class="card ">
                    <table class="table table-bordered">
                        <tr>
                            <th>UAN</th>
                            <td><input type="text" class="form-control" id="inputUAN" name="worker_uan" placeholder="Enter UAN" value="{{ $worker_uan }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Address District Code</th>
                            <td><input type="text" class="form-control" id="inputAddressDistrictCode" name="address_district_code" value="{{ $data['addressDistrictCode'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Primary Skill Code</th>
                            <td><input type="text" class="form-control" id="inputPrimarySkillCode" name="primary_skill_code" value="{{ $data['primarySkillCode'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Guardian Name</th>
                            <td><input type="text" class="form-control" id="inputGuardianName" name="guardian_name" value="{{ $data['guardianname'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td><input type="text" class="form-control" id="inputMobile" name="mobile" value="{{ $data['mobile'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Branch Address</th>
                            <td><input type="text" class="form-control" id="inputBranchAddress" name="branch_address" value="{{ $data['branchAddress'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Social Category</th>
                            <td><input type="text" class="form-control" id="inputSocialCategory" name="social_category" value="{{ $data['socialCategory'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Bank Name</th>
                            <td><input type="text" class="form-control" id="inputBankName" name="bank_name" value="{{ $data['bankName'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Account No</th>
                            <td><input type="text" class="form-control" id="inputAccountNo" name="account_no" value="{{ $data['accountNo'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><input type="text" class="form-control" id="inputName" name="name" value="{{ $data['name'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Nominee Name</th>
                            <td><input type="text" class="form-control" id="inputNomineeName" name="nominee_name" value="{{ $data['nomineeName'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td><input type="date" class="form-control" id="inputDateOfBirth" name="date_of_birth" value="{{ $data['dateOfBirth'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Marital Status Code</th>
                            <td><input type="text" class="form-control" id="inputMaritalStatusCode" name="marital_status_code" value="{{ $data['maritalStatusCode'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Gender Code</th>
                            <td><input type="text" class="form-control" id="inputGenderCode" name="gender_code" value="{{ $data['genderCode'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Address State Code</th>
                            <td><input type="text" class="form-control" id="inputAddressStateCode" name="address_state_code" value="{{ $data['addressStateCode'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>IFSC Code</th>
                            <td><input type="text" class="form-control" id="inputIFSCCode" name="ifsc_code" value="{{ $data['ifscCode'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" class="form-control" id="inputEmail" name="email" value="{{ $data['email'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Nominee DOB</th>
                            <td><input type="date" class="form-control" id="inputNomineeDob" name="nominee_dob" value="{{ $data['nomineeDob'] }}" readonly></td>
                        </tr>
                        <tr>
                            <th>Relationship with Nominee</th>
                            <td><input type="text" class="form-control" id="inputRelationshipWithNominee" name="relationship_with_nominee" value="{{ $data['relationshipWithNominee'] }}" readonly></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
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

