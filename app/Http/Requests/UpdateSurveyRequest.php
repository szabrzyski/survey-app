<?php

namespace App\Http\Requests;

use App\Services\SurveyStatusService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSurveyRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $surveyStatusService = new SurveyStatusService();
        return [
            'name' => ['required', 'string', 'min:1', 'max:255', Rule::unique('App\Models\Survey', 'name')->ignore($this->survey)],
            'status' => ['required', 'integer', Rule::prohibitedIf($this->survey->questions()->doesntExist() && in_array($this->status, $surveyStatusService->getStatuses(questionsRequired:true)->pluck('id')->all())), 'exists:App\Models\SurveyStatus,id'],
        ];
    }

    /**
     * Error messages.
     */
    public function messages(): array
    {
        return [
            'name.*' => 'Nieprawidłowa nazwa badania',
            'status.*' => 'Nieprawidłowy status badania',
        ];
    }
}
