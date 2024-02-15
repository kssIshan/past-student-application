<?php

namespace App\Http\Requests\Education\Exam;

use Illuminate\Foundation\Http\FormRequest;

class ExamSaveRequest extends FormRequest
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


            // 'results.*.subject_id' => 'required|numeric',
            // 'results.*.grade' => 'required',

            'index_no' => 'required|numeric',
            'type' => 'required|string|max:255',
            'exam_year' => 'required|numeric',
            'attempt' => 'required|numeric',
            'island_rank' =>  'nullable|numeric',
            'district_rank' =>  'nullable|numeric',
            'z_score' => 'nullable|decimal:0,4',
            'cut_of_marks' => 'nullable|numeric',
            'subject_stream' => 'nullable|string|max:255',
            'is_pass' => 'nullable|boolean',

            'results' => 'present|array',
            'result.*.subject_id' => 'nullable|integer',
            //'result.*.grade' => 'nullable|string',
            'result.*.grade' => 'required_with:result.*.subject_id,!=,null',

        ];
    }
}
