<?php

namespace App\Http\Requests\Union;

use Illuminate\Foundation\Http\FormRequest;

class StudentUnionSaveRequest extends FormRequest
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
            'union_id' => 'required|numeric',
            //'program_id' => 'sometimes|numeric',
            'position' => 'sometimes|string',
            'duration' => 'sometimes|string',
            'join_date' => 'required|date',
            'leave_date' => 'required|date',
            //'leave_date' => 'required|date|after_or_equal:join_date',
            'unionProjects' => 'nullable|array',
            'unionProjects.*.project_id' => 'nullable|integer',
        ];
    }
}
