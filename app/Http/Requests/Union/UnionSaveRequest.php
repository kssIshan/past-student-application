<?php

namespace App\Http\Requests\Union;

use Illuminate\Foundation\Http\FormRequest;

class UnionSaveRequest extends FormRequest
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
            'studentId' => 'required|numeric',
            'name' => 'required|string',
            'start_date' => 'required|date',
            'status' => 'required|string',
        ];
    }
}
