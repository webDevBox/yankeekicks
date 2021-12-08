<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $rules = [
            'size' => 'required',
            'price' => 'required|numeric|min:1',
            'condition' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'delivery' => ['required',Rule::in(['shippment', 'dropOff'])],
            'images.*' => 'mimes:jpeg,jpg,png,gif'
        ];

        if(!isset($this->id))
        {
            $rules += [
                'images' => 'required'
            ];
        }

        return $rules;
    }
}
