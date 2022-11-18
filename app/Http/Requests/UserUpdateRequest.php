<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest  extends FormRequest
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
//        dd('required', 'string', 'unique:users,name,' . $this->user_id);
        return [
            'login' => ['required', 'string', 'unique:users,name,' . $this->user_id],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user_id, 'id')],
            'password' => ['string', 'nullable'],
            'role' => ['required', 'integer'],
            'avatar' => ['nullable', 'file'],

            'user_id' => ['required', 'integer', 'exists:users,id']
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
            'password.string' => 'Поле должно быть строкой!',
            'avatar.file' => 'Поле должно быть файлом!'
        ];
    }
}
