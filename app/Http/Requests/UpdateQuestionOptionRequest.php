<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateQuestionOptionRequest extends FormRequest
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
            'value' => ['required', 'integer', 'min:-2147483648', 'max:2147483647'],
            'title' => ['required', 'string', 'min:1', 'max:65535', Rule::unique('App\Models\QuestionOption')->ignore($this->questionOption)->where(fn ($query) => $query->where('question_id', $this->questionOption->question_id))],
        ];
    }

    /**
     * Error messages.
     */
    public function messages(): array
    {
        return [
            'value.*' => 'Nieprawidłowa wartość odpowiedzi.',
            'title.*' => 'Nieprawidłowa treść odpowiedzi.',
        ];
    }
}
