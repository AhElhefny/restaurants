<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'name' => ['required','min:3'],
            'email' => ['required','min:3',request()->method() == 'POST'?
                Rule::unique('users','email'):
                Rule::unique('users','email')->ignore(auth()->user()->id)
            ],
            'address' => ['required'],
            'password' => request()->method() == 'POST'?
                ['required','confirmed','min:5']:
                ['confirmed',request('password')?'min:5':'']
            ,
            'phone' => ['nullable','digits:9']
        ];
    }
}
