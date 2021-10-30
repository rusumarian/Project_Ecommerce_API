<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => ['required', Rule::exists('product_categories', 'id')],
            'description' => 'required|max:255',
            'price' => 'required|gt:0|lte:99999',
            'color' => 'required|max:255',
            'quantity' => 'required|gte:0'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Trebuie să introduci titlul',
            'title.max' => 'Incearca sa introduci maxim 255 de caractere',
            'description.required' => 'Trebuie să introduci o descriere',
            'description.max' => 'Incearca sa introduci maxim 255 de caractere',
            'price.required' => 'Trebuie să introduci un pret',
            'price.gt' => 'Pretul trebuie sa fie mai mare ca 0',
            'price.lte' => 'Pretul trebuie sa fie mai mic decat 99999 euro',
            'color.required' => 'Trebuie să introduci culoarea produsului',
            'color.max' => 'Culoarea poate avea maxim 255 de caractere',
            'quantity.required' => 'Trebuie sa introduci cantitatea.',
            'quantity.gte' => 'Cantitatea trebuie sa fie mai mare sau egala cu 0'
        ];
    }
}
