<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'captcha'  => ['required', 'captcha'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array {
        return [
            'email.required'    => 'Please enter your email address.',
            'email.email'       => 'The email address must be valid.',
            'password.required' => 'Please enter your password.',
            'password.min'      => 'Your password must be at least 8 characters long.',
            'captcha.required'  => 'Please complete the captcha.',
            'captcha.captcha'   => 'The captcha is incorrect. Please try again.',
        ];
    }
}
