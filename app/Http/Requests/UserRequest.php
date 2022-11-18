<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest  extends FormRequest
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
            'login' => ['required', 'string', 'unique:users,name'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string'],
            'role' => ['required', 'integer'],
            'avatar' => ['nullable', 'file']
        ];

    }

    public function messages()
    {
        return [
            'login.required' => 'Поле обязательно для заполнения!',
            'login.string' => 'Поле должно быть строкой!',
            'login.unique' => 'Такой логин уже существует!',
            'email.required' => 'Поле обязательно для заполнения!',
            'email.email' => 'Поле должно быть email!',
            'email.unique' => 'Электронный адрес уже зарегестрирован!',
//            'password.required' => 'Поле обязательно для заполнения!',
//            'password.string' => 'Поле должно быть строкой!',
            'avatar.file' => 'Поле должно быть файлом!'
        ];
    }
}
