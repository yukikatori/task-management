<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:20|unique:categories,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'カテゴリ名を入力してください',
            'name.max' => 'カテゴリ名は20文字以内で入力してください',
            'name.unique' => '入力したカテゴリ名は既に使用されています',
        ];
    }
}
