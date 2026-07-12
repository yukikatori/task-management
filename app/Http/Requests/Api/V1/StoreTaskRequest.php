<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Priority;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:100',
            'priority' => ['required', new Enum(Priority::class)],
            'due_date' => 'required|date|after_or_equal:today',
            'completed_at' => 'nullable|date',
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは255文字以内で入力してください',
            'description.max' => '説明は100文字以内で入力してください',
            'priority.required' => '優先度を入力してください',
            'priority.enum' => '入力した優先度は存在しません',
            'due_date.required' => '期日を入力してください',
            'due_date.after_or_equal' => '過去の日付は入力できません',
            'categories.required' => 'カテゴリを入力してください',
        ];
    }
}
