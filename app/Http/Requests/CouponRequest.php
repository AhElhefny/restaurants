<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'promo_code' => ['required',request()->method()=='post'?
                Rule::unique('coupons','promo_code') :
                Rule::unique('coupons','promo_code')->ignore($this->id)],
            'available_until' => ['required','date','after:'.date('Y-m-d')],
            'discount_amount' => ['required','numeric'],
            'number_of_use' => ['required','numeric'],
            'min_amount' => ['required','numeric'],
        ];
    }
}
