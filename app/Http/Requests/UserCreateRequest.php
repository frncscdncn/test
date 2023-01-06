<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:App\Models\User',
            'password' => 'required',
            'name' => 'required',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Поле "Эл. почта" не может быть пустым!',
            'email.unique' => 'E-mail уже используется',
            'password.required' => 'Поле "Пароль" не может быть пустым!',
            'name.required' => 'Поле "Имя" не может быть пустым!'
        ];
    }
}
