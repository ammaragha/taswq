<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric',
            'quantities' => 'required|min:1',
            'discount' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'subcat_id' => 'required',
            'brand_id' => 'required',
            'image' => ($this->method() == 'POST' ? 'required|' : "").'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ];
    }
}
