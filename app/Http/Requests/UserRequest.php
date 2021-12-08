<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'role' => ['nullable',
            Rule::in([0,2]),]
        ];

        if(isset($this->id))
        {
            $rules += [
                'amount' => 'required|numeric',
                'status' => ['required',
            Rule::in([0,1]),
            ]];
        }
        else
        {
            $rules += [
                'email' => 'required|unique:users,email'];
        }

        return $rules;
    }
}
