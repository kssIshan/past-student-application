<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectSaveRequest extends FormRequest
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
            'student_id' => 'required|numeric',
            'name' => 'required|string',
            'status' => 'sometimes|string',
            'duration' => 'sometimes|string',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ];
    }
}
