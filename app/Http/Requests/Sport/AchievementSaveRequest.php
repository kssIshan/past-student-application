<?php

namespace App\Http\Requests\Sport;

use Illuminate\Foundation\Http\FormRequest;

class AchievementSaveRequest extends FormRequest
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
            'sport_id' => 'required_if:achievement_type,Sports|nullable|numeric',
            //'student_id' => 'required|numeric',
            'achievement_name' => 'required|string|max:255',
            'achievement_date' => 'nullable|date',
            'achievement_type' => 'required|string|max:255',
            'achievement_level' => 'nullable|string|max:255',
            'achievement_status' => 'nullable|string|max:255',
            'age_gap' => 'required|string|max:255',
            'description' => 'nullable|string|max:255'

            // 'check_box' => 'sometimes|boolean|max:255',
            // 'shedule_date' => 'required_if:check_box,true|nullable|date',

        ];
    }
}
