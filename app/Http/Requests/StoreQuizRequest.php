<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRequest extends FormRequest
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
            'tierId' => 'required|exists:tiers,id',
            'questions' => 'required|array',
            'questions.*.quiz_text' => 'required|string',
            'questions.*.options' => 'required|array|max:4',
            'questions.*.correctAnswer' => 'nullable|string|max:255',
            'questions.*.points' => 'nullable|integer',
        ];
    }
}
