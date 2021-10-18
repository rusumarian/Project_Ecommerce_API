<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|gt:0|lte:99999',
            'color' => 'required|max:255',
            'quantity' => 'required'
        ];
    }
}
