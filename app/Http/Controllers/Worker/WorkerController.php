<?php

namespace App\Http\Controllers\Worker;

use App\Models\Eshram;
use App\Models\Gender;
use App\Models\Worker;
use App\Models\WorkerType;
use App\Models\LGDDistrict;
use Illuminate\Http\Request;
use App\Models\CodeDirectory;
use App\Models\MaritalStatus;
use App\Models\SocialCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class WorkerController extends Controller
{
    public function registerWorker(Request $request) {
        return view('pages.worker.register');
    }

    public function validateOTP() {
        $worker_type = WorkerType::with('codeDirectory')->get();
        $worker_mobile_field = true;

        return view('pages.worker.validate_otp', [
            'worker_type' => $worker_type,
            'worker_mobile_field' => $worker_mobile_field
        ]);
    }

    public function validateWorkerOTP(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'worker_uan' => 'required|string|max:255',
                'worker_dob' => 'required|date_format:d-M-Y'
            ], [
                'worker_uan.required' => 'The worker UAN field is required.',
                'worker_uan.string' => 'The worker UAN must be a string.',
                'worker_uan.max' => 'The worker UAN may not be greater than 255 characters.',
                'worker_dob.required' => 'The worker date of birth field is required.',
                'worker_dob.date_format' => 'The worker date of birth must be in the format d-M-Y.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $body = array(
                            "code" => 1,
                            "message" => "Success",
                            "data" => [
                                "msg" => "OTP has been sent to XXXXXX5909 as registered with eShram",
                                "code" => 1,
                                "dob" => "1993-01-01",
                                "mobileNumber" => "7042565909",
                                "customData" => null,
                                "jwtToken" => null,
                                "uanNo" => "710482237929"
                            ]
                        );
                    
                // $response = Http::post(config('app.eshram_api_url'), [
                //     '_token' => $request->input('_token'),
                //     'worker_name' => $request->input('worker_name'),
                //     'worker_uan' => $request->input('worker_uan'),
                //     'worker_dob' => $request->input('worker_dob'),
                //     'gender' => $request->input('gender'),
                // ]);
    
                // if ($response->failed()) {
                //     return redirect()->back()->withErrors($response->json());
                // }
    
                // $body = $response->json();
    
                if ($body['message'] == 'Success') {
                    $existing_eshram = Eshram::where('uan', $request->worker_uan)->first();
                    
                    if ($existing_eshram) {
                        $existing_eshram->json_data_after_requesting_otp = json_encode($body['data'], JSON_UNESCAPED_SLASHES);
                        $existing_eshram->save();
                    } else {
                        $eshram = new Eshram();
                        $eshram->user_id = Auth::user()->id;
                        $eshram->uan = $request->worker_uan;
                        $eshram->json_data_after_requesting_otp = json_encode($body['data'], JSON_UNESCAPED_SLASHES);
                        $eshram->save();
                    }
                    $worker_type = WorkerType::with('codeDirectory')->get();

                    return view('pages.worker.validate_otp', [
                        'worker_uan' => $request->worker_uan,
                        'worker_dob' => $request->worker_dob, 
                        'worker_type' => $worker_type,
                        'worker_mobile_number' => $body['data']['mobileNumber'] ?? null
                    ]);
                }
            }


        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    public function validatingOTP(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'worker_uan' => 'required|string|max:255',
                'worker_dob' => 'required|date_format:d-M-Y',
                'worker_otp' => 'required|string|max:255',
                'worker_mobile_number' => 'required|string|max:255',
                'worker_type' => 'required',
                'took_consent' => 'required',
            ], [
                'worker_uan.required' => 'The worker UAN field is required.',
                'worker_uan.string' => 'The worker UAN must be a string.',
                'worker_uan.max' => 'The worker UAN may not be greater than 255 characters.',
                'worker_dob.required' => 'The worker date of birth field is required.',
                'worker_dob.date_format' => 'The worker date of birth must be in the format d-M-Y.',
                'worker_otp.required' => 'The worker OTP field is required.',
                'worker_otp.string' => 'The worker OTP must be a string.',
                'worker_otp.max' => 'The worker OTP may not be greater than 255 characters.',
                'worker_mobile_number.required' => 'The worker mobile number field is required.',
                'worker_mobile_number.string' => 'The worker mobile number must be a string.',
                'worker_mobile_number.max' => 'The worker mobile number may not be greater than 255 characters.',
                'worker_type.required' => 'The worker type field is required.',
                'took_consent.required' => 'The took consent field is required.',
            ]);

            if ($validator->fails()) {
                return redirect()->route('validate-otp')
                     ->withErrors($validator)
                     ->withInput();
            } else {
                // Hit the first API to validate the OTP is matching
                // $response = Http::post(config('app.eshram_api_url'), [
                //     '_token' => $request->input('_token'),
                //     'worker_name' => $request->input('worker_name'),
                //     'worker_uan' => $request->input('worker_uan'),
                //     'worker_dob' => $request->input('worker_dob'),
                //     'worker_otp' => $request->input('worker_otp'),
                //     'worker_mobile_number' => $request->input('worker_mobile_number'),
                // ]);
    
                // if ($response->failed()) {
                //     return redirect()->back()->withErrors($response->json());
                // }

                // If the response is success, then expect the decrypted message that needs to be saved on the table
                $body = array(
                        "code" => 1,
                        "message" =>  "Success",
                        "data" => [
                            "encRequestData" => "PpmRcCPLH4kvWiwoAiINniKieDLjP5ROAOWav+KP654puUGf/UPPypC/qYAPiJr1HbO4Mg3vrR8ixg9IiiJPWW4kd0rqVuJH5sBQQoLW+wWjrKkHjOWNEgJaRp8EJzAusC7Trra5gboy3WsTtFfhW1LVqW32+Md1oJFcayLuaDM9YTfg9grN2p7qUTAXfc19cwH778aNho8MZEB/xkqtk7GW3l/6qD0jqzVKdlvMoW18KhhS0CbIt2JG0UkR6FBEH9XjoluMh9i0vmB7ZZgV6Kdy3t+Sebjck4u/psrSYzaWygY9xqRdAaeU8JD7A1dT7M317hHFLicQ/pVhAiCqNjZtwkOoVQSNBrnyRXkhhmUjWmNb30fVl05ggCOEVow+r4GvC5HRdYP7OtzQtwGgGXrZPjbk06IAXvrkgbQ26o789Tw8BEvjkm4u/3orIDh7ooCBxQgr3FZ0YyN5m1IiazM78HgLA7+Gm7/zdfMzzgjXSRQGYSOCbuBSjZ3jI9NWwOlzeFMzTOW8ou8NZE4sK7XP7Wrs0UM/GLGXhqZmKAg=",
                            "txnId" => "MAA60551605048020250604160349081NDUW"
                        ]
                    );
                
                if ($body['message'] == 'Success') {
                    $eshram = Eshram::where('user_id', Auth::user()->id)
                                    ->where('uan', $request->input('worker_uan'))
                                    ->first();
                    $eshram->json_data_after_validating_otp_encrypted = json_encode($body['data'], JSON_UNESCAPED_SLASHES);
                    $eshram->took_consent = $request->took_consent;
                    $eshram->save();

                    // Now hit the second API to get the decrypted data and expect the data should be in this form and save it again on the table
                     $decrypted_data = array(
                                        "addressDistrictCode" => "661",
                                        "primarySkillCode" => "",
                                        "guardianname" => "",
                                        "mobile" => "7042565909",
                                        "branchAddress" => "",
                                        "socialCategory" => "OBC",
                                        "bankName" => "",
                                        "nomineeName" => "Anjum Khan",
                                        "dateOfBirth" => "1993-01-01",
                                        "maritalStatusCode" => "2",
                                        "genderCode" => "M",
                                        "addressStateCode" => "9",
                                        "accountNo" => "",
                                        "name" => "Mahboob Ali",
                                        "nomineeDob" => "1996-01-01",
                                        "relationshipWithNominee" => "15",
                                        "ifscCode" => "",
                                        "email" => "mahboobali66@gmail.com",
                                        "aadharMobile" => "9988776655",
                                        "eshramMobile" => "5544332211",
                                        "permanentStateName" => "N/A",
                                        "permanentDistrictName" => "N/A",
                                        "localStateName" => "N/A",
                                        "localDistrictName" => "N/A",
                                        "occupationAsPerEshram" => "",
                                        "photoAsPerEshram" => "",
                                        "hashedAadhar" => "",
                                        "aadharAddress" => "",
                                        "alternateMobileNumber" => "",
                                        "fatherName" => "",
                                        "husbandName" => "",
                                    );

                    $eshram->json_data_after_validating_otp_decrypted = json_encode($decrypted_data, JSON_UNESCAPED_SLASHES);
                    $eshram->save();

                    // Find the gender type
                    if($decrypted_data['genderCode']) {
                        $code_directory_gender = CodeDirectory::where('code', $decrypted_data['genderCode'])->with('gender')->first();
                        $decrypted_data['gender_label'] = $code_directory_gender->gender->name;
                        $decrypted_data['gender_id'] = $code_directory_gender->gender->id;
                    } else {
                        $decrypted_data['gender_label'] = '';
                        $decrypted_data['gender_id'] = '';
                    }

                    // find the worker type
                    $code_directory_worker_type = CodeDirectory::where('code', $request->worker_type)->with('workerType')->first();
                    $decrypted_data['worker_type_label'] = $code_directory_worker_type->workerType->name;
                    $decrypted_data['worker_type'] = $code_directory_worker_type->code;

                    // find the social category type
                    if($decrypted_data['socialCategory']) {
                        $code_directory_social_category = CodeDirectory::where('code', $decrypted_data['socialCategory'])->with('socialCategory')->first();
                        $decrypted_data['social_category_label'] = $code_directory_social_category->socialCategory->name;
                        $decrypted_data['social_category'] = $code_directory_social_category->code;
                    } else {
                        $decrypted_data['social_category_label'] = '';
                        $decrypted_data['social_category'] = '';
                    }
                    
                    // find the marital status type
                    if($decrypted_data['maritalStatusCode']) {
                        $code_directory_marital_status = CodeDirectory::where('code', $decrypted_data['maritalStatusCode'])->with('maritalStatus')->first();
                        $decrypted_data['marital_status_label'] = $code_directory_marital_status->maritalStatus->name;
                        $decrypted_data['marital_status'] = $code_directory_marital_status->code;
                    } else {
                        $decrypted_data['marital_status_label'] = '';
                        $decrypted_data['marital_status'] = '';
                    }
                    
                    $decrypted_data['uan_number'] = $eshram->uan;
                    $decrypted_data['eshram_id'] = $eshram->id;

                    session([
                        'data' => $decrypted_data,
                    ]);

                    // Show the data to user so that he can validate it
                    return view('pages.worker.view_eshram_data', [
                        'data' => $decrypted_data, 
                    ])->withInput($request->all());
                }
            }

        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    public function saveEshramData(Request $request) {
        try {
            $decrypted_data = session('data');

            $worker_type_id = WorkerType::where('name', $decrypted_data['worker_type_label'])->value('id');
            $gender_id = Gender::where('name', $decrypted_data['gender_label'])->value('id');
            $social_category_id = SocialCategory::where('name', $decrypted_data['social_category_label'])->value('id');
            $marital_status_id = MaritalStatus::where('name', $decrypted_data['marital_status_label'])->value('id');

            // Save logic
            $worker = Worker::updateOrCreate(
                ['uan_number' => $decrypted_data['uan_number']],
                [
                    'worker_type_id' => $worker_type_id ?? null,
                    'uan_number' => $decrypted_data['uan_number'] ?? '',
                    'eshram_id' => $decrypted_data['eshram_id'] ?? null,
                    'aadhar_photo' => $decrypted_data['photoAsPerEshram'] ?? null,
                    'aadhar_name' => $decrypted_data['name'] ?? null,
                    'gender_id' => $gender_id ?? null,
                    'aadhar_dob_yob' => $decrypted_data['dateOfBirth'] ?? null,
                    'aadhar_address' => $decrypted_data['aadharAddress'] ?? null,
                    'hashed_aadhaar' => $decrypted_data['hashedAadhar'] ?? null,
                    'mobile_number' => $decrypted_data['mobile'] ?? '',
                    'alternate_mobile_number' => $decrypted_data['eshramMobile'] ?? null,
                    'father_name' => $decrypted_data['fatherName'] ?? null,
                    'husband_name' => $decrypted_data['husbandName'] ?? null,
                    'social_category_id' => $social_category_id ?? null,
                    'marital_status_id' => $marital_status_id ?? null,
                ]);

            // Redirect based on which button was pressed
            if ($request->input('action') === 'save_and_add_family') {
                session()->forget('data');
                return redirect()->route('add-family-form')->with('success', 'Worker saved. Proceed to add family details.');
            } else {
                session()->forget('data');
                return redirect()->route('register-worker')->with('success', 'Worker saved successfully.');
            }
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    public function registeredWorkers() {
        try {
            $registered_workers = Worker::with('workerType.codeDirectory')->get();
            return view('pages.worker.registered_workers', [
                'registered_workers' => $registered_workers
            ]);
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    public function showRegisteredWorker($id) {
        try {
            $worker = Worker::with([
                'gender.codeDirectory',
                'socialCategory.codeDirectory',
                'maritalStatus.codeDirectory',
                'workerType.codeDirectory',
            ])->findOrFail($id);

            $data = [
                'worker_type_label'         => optional(optional($worker->workerType)->codeDirectory)->name ?? 'N/A',
                'photoAsPerEshram'          => null, // If needed
                'name'                      => $worker->aadhar_name ?? '',
                'genderCode'                => optional(optional($worker->gender)->codeDirectory)->code ?? 'N/A',
                'genderLabel'               => optional(optional($worker->gender)->codeDirectory)->name ?? 'N/A',
                'socialCategory'            => optional(optional($worker->socialCategory)->codeDirectory)->name ?? 'N/A',
                'dateOfBirth'               => $worker->aadhar_dob_yob ?? '',
                'maritalStatusCode'         => optional(optional($worker->maritalStatus)->codeDirectory)->code ?? '',
                'maritalStatusLabel'        => optional(optional($worker->maritalStatus)->codeDirectory)->name ?? 'N/A',
                'guardianname'              => $worker->father_name ?? $worker->husband_name ?? '',
                'email'                     => '', // If needed
                'mobile'                    => $worker->mobile_number ?? '',
                'addressDistrictCode'       => '661', // Replace with dynamic value if available
                'addressStateCode'          => '9',   // Replace with dynamic value if available
                'aadharMobile'              => $worker->mobile_number ?? '',
                'eshramMobile'              => $worker->alternate_mobile_number ?? '',
                'permanentStateName'        => 'N/A',
                'permanentDistrictName'     => 'N/A',
                'localStateName'            => 'N/A',
                'localDistrictName'         => 'N/A',
                'primarySkillCode'          => '',
                'occupationAsPerEshram'     => '',
                'accountNo'                 => '',
                'ifscCode'                  => '',
                'branchAddress'             => '',
                'nomineeName'               => '',
                'nomineeDob'                => '',
                'relationshipWithNominee'   => '',
            ];
            if($worker->address_district_code) {
                $district = LGDDistrict::where('district_lgd_code', $worker->address_district_code)->first();
                $data['addressDistrictName'] = $district ? $district->district_name_en : 'N/A';

            } else {
                $data['addressDistrictName'] = 'N/A';
            }


            return view('pages.worker.show_registered_worker', [
                'data' => $data,
                'worker_uan' => $worker->uan_number,
            ]);

        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    public function destroyRegisteredWorker($id) {
        try {
            $worker = Worker::findOrFail($id);
            $worker->delete();
            return redirect()->route('registered-workers')->with('success', 'Worker deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }



}