<?php

namespace App\Http\Requests\CodeDirectory;

use Illuminate\Foundation\Http\FormRequest;

class StoreCodeDirectoryRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:255', 'unique:code_directories,code'],
            'name' => ['required', 'string', 'max:255'],
            'table_name' => ['required', 'string'],
        ];
    }

    public function messages(): array {
        return [
            'code.required' => 'Code is required.',
            'code.string' => 'Code must be a string.',
            'code.max' => 'Code must not be greater than 255 characters.',
            'code.unique' => 'Code has already been taken.',
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name must not be greater than 255 characters.',
            'table_name.required' => 'Table name is required.',
            'table_name.string' => 'Table name must be a string.',
        ];
    }
}
