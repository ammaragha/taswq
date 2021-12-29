<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'phone' => 'required|numeric',
            'birthday' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|required_with:password|same:password',
        ];
    }

    
    
    
}
