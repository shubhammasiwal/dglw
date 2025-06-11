<?php

namespace App\Http\Controllers\Worker;

use App\Models\Eshram;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WorkerController extends Controller
{
    public function registerWorker(Request $request) {
        return view('pages.worker.register');
    }

    public function validateWorkerOTP(Request $request) {
        try {
            $this->validate($request, [
                '_token' => 'required|string',
                'worker_name' => 'required|string|max:255',
                'worker_uan' => 'required|string|max:255',
                'worker_dob' => 'required|date_format:d-M-Y',
                'gender' => 'required|in:Male,Female,Other'
            ], [
                '_token.required' => 'The CSRF token field is required.',
                '_token.string' => 'The CSRF token must be a string.',
                'worker_name.required' => 'The worker name field is required.',
                'worker_name.string' => 'The worker name must be a string.',
                'worker_name.max' => 'The worker name may not be greater than 255 characters.',
                'worker_uan.required' => 'The worker UAN field is required.',
                'worker_uan.string' => 'The worker UAN must be a string.',
                'worker_uan.max' => 'The worker UAN may not be greater than 255 characters.',
                'worker_dob.required' => 'The worker date of birth field is required.',
                'worker_dob.date_format' => 'The worker date of birth must be in the format d-M-Y.',
                'gender.required' => 'The worker gender field is required.',
                'gender.in' => 'The worker gender must be either Male, Female or Other.'
            ]);

            // Hardcoded response to simulate the actual response from Esharm API
            // Also change the DOB format 1993-01-01
            // Request Body
            // {
            //     "uanNo":"710482237929",
            //     "aadhaarDoB":"1993-01-01",
            //     "orgId":"MAAN001",
            //     "adHashed256":"45d6e4c2281c764ce60595403ceb69dd19b5d7cd166b2dec502aa8209f054847"
            // }

            // Response Body
            // {
            //     "code": 1,
            //     "message": "Success",
            //     "data": "[{\"msg\":\"OTP has been sent to XXXXXX5909 as registered with eShram\",\"code\":1,\"dob\":\"1993-01-01\",\"mobileNumber\":\"7042565909\",\"customData\":null,\"jwtToken\":null,\"uanNo\":\"710482237929\"}]"
            // }
            $body = array(
                        "code" => 1,
                        "message" => "Success",
                        "data" => "[{\"msg\":\"OTP has been sent to XXXXXX5909 as registered with eShram\",\"code\":1,\"dob\":\"1993-01-01\",\"mobileNumber\":\"7042565909\",\"customData\":null,\"jwtToken\":null,\"uanNo\":\"710482237929\"}]"
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
                    $existing_eshram->json_data_after_otp = json_encode($request->all(), JSON_UNESCAPED_SLASHES);
                    $existing_eshram->save();
                } else {
                    $eshram = new Eshram();
                    $eshram->user_id = Auth::user()->id;
                    $eshram->uan = $request->worker_uan;
                    $eshram->json_data_after_otp = json_encode($request->all(), JSON_UNESCAPED_SLASHES);
                    $eshram->save();
                }

                // dd($request->worker_uan,$request->worker_dob, $request->worker_name,json_decode($body['data'], true)[0]['mobileNumber']);
                return view('pages.worker.validate_otp', [
                    'worker_uan' => $request->worker_uan,
                    'worker_dob' => $request->worker_dob, 
                    'worker_name' => $request->worker_name,
                    'worker_mobile_number' => json_decode($body['data'], true)[0]['mobileNumber']
                ]);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function validatingOTP(Request $request) {
        try {
            $this->validate($request, [
                '_token' => 'required|string',
                'worker_name' => 'required|string|max:255',
                'worker_uan' => 'required|string|max:255',
                'worker_dob' => 'required|date_format:d-M-Y',
                'worker_otp' => 'required|string|max:255',
                'worker_mobile_number' => 'required|string|max:255',
            ], [
                '_token.required' => 'The CSRF token field is required.',
                '_token.string' => 'The CSRF token must be a string.',
                'worker_name.required' => 'The worker name field is required.',
                'worker_name.string' => 'The worker name must be a string.',
                'worker_name.max' => 'The worker name may not be greater than 255 characters.',
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
            ]);

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

            $body = array(
                    "code" => 1,
                    "message" =>  "Success",
                    "data" => "[{\"encRequestData\":\"PpmRcCPLH4kvWiwoAiINniKieDLjP5ROAOWav+KP654puUGf/UPPypC/qYAPiJr1HbO4Mg3vrR8ixg9IiiJPWW4kd0rqVuJH5sBQQoLW+wWjrKkHjOWNEgJaRp8EJzAusC7Trra5gboy3WsTtFfhW1LVqW32+Md1oJFcayLuaDM9YTfg9grN2p7qUTAXfc19cwH778aNho8MZEB/xkqtk7GW3l/6qD0jqzVKdlvMoW18KhhS0CbIt2JG0UkR6FBEH9XjoluMh9i0vmB7ZZgV6Kdy3t+Sebjck4u/psrSYzaWygY9xqRdAaeU8JD7A1dT7M317hHFLicQ/pVhAiCqNjZtwkOoVQSNBrnyRXkhhmUjWmNb30fVl05ggCOEVow+r4GvC5HRdYP7OtzQtwGgGXrZPjbk06IAXvrkgbQ26o789Tw8BEvjkm4u/3orIDh7ooCBxQgr3FZ0YyN5m1IiazM78HgLA7+Gm7/zdfMzzgjXSRQGYSOCbuBSjZ3jI9NWwOlzeFMzTOW8ou8NZE4sK7XP7Wrs0UM/GLGXhqZmKAg=\",\"txnId\":\"MAA60551605048020250604160349081NDUW\"}]"
                );

            // $encrypted = json_decode($body['data'], true)[0]['encRequestData'];
                        // If you know the key and IV:
            // $key = 'your-32-character-secret-key';
            // $iv = 'your-16-byte-iv-here'; // Must be 16 bytes

            // $decrypted = openssl_decrypt(
            //     base64_decode($encrypted),
            //     'AES-256-CBC',
            //     $key,
            //     OPENSSL_RAW_DATA,
            //     $iv
            // );


            // assumming after encryption the data would look like this
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
                                    "email" => "mahboobali66@gmail.com"
                                );

            // $body = $response->json();
            if ($body['message'] == 'Success') {
                $eshram = Eshram::where('user_id', Auth::user()->id)
                ->where('uan', $request->input('worker_uan'))
                ->first();
                $eshram->json_data_after_validating_otp = json_encode($request->all(), JSON_UNESCAPED_SLASHES);
                $eshram->save();
                // Show the data to user so that he can validate it
                return view('pages.worker.view_eshram_data', [
                    'data' => $decrypted_data, 
                    "worker_name" => $request->input('worker_name') ,
                    "worker_uan" => $request->input('worker_uan') ,
                    "worker_dob" => $request->input('worker_dob') ,
                    "worker_otp" => $request->input('worker_otp') ,
                    "worker_mobile_number" => $request->input('worker_mobile_number') ,
                ])->withInput($request->all());
            }
            dd("something went wrong");
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    // public function viewEshramData(Request $request) {
    //     dd($request->all());
    // }

    public function postEshramData(Request $request) {
        try {
            dd($request->all());
            dd("something went wrong");
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}