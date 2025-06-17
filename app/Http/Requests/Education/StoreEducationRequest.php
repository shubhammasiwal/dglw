<?php

namespace App\Http\Requests\Education;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEducationRequest extends FormRequest
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
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('code_directories')->where(function ($query) {
                    return $query->where('table_name', $this->input('table_name'));
                })
            ],
            'name' => ['required', 'string', 'max:255'],
            'table_name' => ['required', 'string'],
        ];
    }

    public function messages(): array {
        return [
            'code.required' => 'Code is required.',
            'code.string' => 'Code must be a string.',
            'code.max' => 'Code must not be greater than 255 characters.',
            'code.unique' => 'This code and category combination has already been taken.',
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name must not be greater than 255 characters.',
            'table_name.required' => 'Category type is required.',
            'table_name.string' => 'Category type must be a string.',
        ];
    }
}
