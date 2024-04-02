<?php

namespace App\Http\Requests\QuestionController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'text' => 'required|string|max:255',
            'type' => 'required|string',
            'img.*'  => 'nullable|file',
            'answ_text.*'  => 'nullable|string',
            'next_question_id.*'  => 'nullable|string',
            'required' => 'nullable|string',
            'answ_id' => 'nullable|array'
        ];
    }

    public function messages(): array
    {
        return [
            'text.required' => 'Укажите текст',
            'type.required' => 'Выберите тип'
        ];
    }
}
