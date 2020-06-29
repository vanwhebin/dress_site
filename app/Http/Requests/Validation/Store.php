<?php

namespace App\Http\Requests\Validation;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    // public function attributes()
    // {
    //     // return [
    //     //     // 'tag' => '标签',
    //     // ];
    //
    // }


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
            'tag'       => 'required',
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
        ];
    }


    public function messages()
    {
        return [
            'tag.required' => '必须选择标签'
        ];
    }

}
