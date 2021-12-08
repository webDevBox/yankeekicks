<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'password' => 'nullable|min:6',
            'image' => 'nullable|image'
        ];

        if(user()->role == 1)
        {
            $rules += [
                'email' => 'required|unique:users,email,'.user()->id
            ];
        }
        
        return $rules;
    }
}
