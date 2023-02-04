<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQuestionRequest extends FormRequest
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
        return [
            'type' => 'required|integer|exists:App\Models\QuestionType,id',
            'position' => ['required', 'integer', 'min:1', 'max:4294967295', Rule::unique('App\Models\Question')->where(fn ($query) => $query->where('survey_id', $this->survey->id))],
            'title' => ['required', 'string', 'min:1', 'max:65535', Rule::unique('App\Models\Question')->where(fn ($query) => $query->where('survey_id', $this->survey->id))],
        ];
    }

    /**
     * Error messages.
     */
    public function messages(): array
    {
        return [
            'type.*' => 'Nieprawidłowy typ pytania.',
            'position.*' => 'Nieprawidłowa pozycja pytania.',
            'title.*' => 'Nieprawidłowa treść pytania.',
        ];
    }
}
