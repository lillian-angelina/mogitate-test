<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeasonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:seasons,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '季節名は必須です。',
            'name.string' => '季節名は文字列である必要があります。',
            'name.max' => '季節名は255文字以内で入力してください。',
            'name.unique' => 'この季節名はすでに登録されています。',
        ];
    }
}
