<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
            'reg_no' => 'required|numeric',
            //'reg_no' => 'required|unique:students,reg_no',
            'nic' => 'required|string|max:255',
            //'full_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'date_of_admission' => 'required|date',
            'date_of_leave' => 'required|date',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'mobile_no' => 'nullable|numeric',
            'mobile_no2' => 'nullable|numeric',
            'land_no' => 'nullable|numeric',
        ];
    }
}
