<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255|unique:App\Models\Survey,name',
        ];
    }

    /**
     * Error messages.
     */
    public function messages(): array
    {
        return [
            'name.*' => 'Nieprawidłowa nazwa badania',
        ];
    }
}
