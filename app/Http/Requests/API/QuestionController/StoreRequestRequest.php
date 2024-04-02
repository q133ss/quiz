<?php

namespace App\Http\Requests\API\QuestionController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestRequest extends FormRequest
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
            'phone' => 'min:11|required|string',
            'questions' => 'array|required',
            'answers' => 'array|required'
        ];
    }

    public function messages(): array
    {
        return [
            'phone.min' => 'Неверный формат телефона',
            'phone.required' => 'Введите телефон',
            'phone.string' => 'Телефон должен быть строкой'
        ];
    }
}
