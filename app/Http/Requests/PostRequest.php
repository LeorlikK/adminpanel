<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
            'category_id' => ['required'],
            'tags_id' => ['nullable', 'array'],
            'tags_id.*' => ['nullable', 'integer', 'exists:tags,id'],
            'image' => ['nullable', 'file']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле обязательно',
            'title.string' => 'Символы должны быть строкой',
            'text.required' => 'Поле обязательно',
            'text.string' => 'Символы должны быть строкой',
            'category_id.required' => 'Выберите категорию',
            'tags_id.string' => 'Символы должны быть строкой',
            'tags_id.array' => 'Передан не массив',
            'image.file' => 'Поле должно содержать файл'
        ];
    }
}
