<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->route('user') . ',id'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name must not be greater than :max characters.',
            'email.required' => 'Email is required',
            'email.string' => 'Email must be a string.',
            'email.email' => 'Email must be a valid email address.',
            'email.max' => 'Email must not be greater than :max characters.',
            'email.unique' => 'Email already exists',
            'role.required' => 'Role is required',
            'role.string' => 'Role must be a string.',
            'role.max' => 'Role must not be greater than :max characters.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least :min characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
