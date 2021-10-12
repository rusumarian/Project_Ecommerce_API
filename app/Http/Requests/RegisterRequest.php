<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required|min:10|max:15|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:255'
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Trebuie să introduci prenumele',
            'first_name.max' => 'Ai introdus prea multe caractere',
            'last_name.required' => 'Trebuie să introduci numele',
            'last_name.max' => 'Ai introdus prea multe caractere',
            'phone_number.required' => 'Trebuie să introduci numarul de telefon',
            'phone_number.min' => 'Trebuie să introduci măcar 10 cifre',
            'phone_number.max' => 'Poti introduce maxim 30 de cifre',
            'phone_number.unique' => 'Acest numar de telefon exista deja in baza de date',
            'email.required' => 'Trebuie să introduci emailul',
            'email.email' => 'Acesta nu este un email valid, emailul trebuie sa contina @',
            'email.unique' => 'Acest email exista deja in baza de date',
            'password.required' => 'Trebuie să introduci parola',
            'password.min' => 'Parola trebuie sa contina minim 3 caractere',
            'password.max' => 'Parola ta contine prea multe caractere, incearca sa te limitezi la 255 de caractere'
        ];
    }
}
