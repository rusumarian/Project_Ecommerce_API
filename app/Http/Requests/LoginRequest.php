<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|password|min:3|max:255'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Trebuie să introduci emailul',
            'email.email' => 'Acesta nu este un email valid, emailul trebuie sa contina @',
            'password.required' => 'Trebuie să introduci parola',
            'password.min' => 'Parola trebuie sa contina minim 3 caractere',
            'password.max' => 'Parola ta contine prea multe caractere, incearca sa te limitezi la 255 de caractere'
        ];
    }
}
