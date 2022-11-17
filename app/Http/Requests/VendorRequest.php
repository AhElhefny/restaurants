<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorRequest extends FormRequest
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
            'name_ar' => ['required','min:5','max:150',
                request()->method()=='POST'?
                    Rule::unique('vendors','name_ar') : Rule::unique('vendors','name_ar')->ignore($this->vendor->id)],
            'name_en' => ['required','min:5','max:150',
                request()->method()=='POST'?
                    Rule::unique('vendors','name_en') : Rule::unique('vendors','name_en')->ignore($this->vendor->id)],
            'password' => [Rule::requiredIf(request()->method() == 'POST'),'confirmed'],
            'email' => ['required','email',
                request()->method()=='POST'? Rule::unique('users','email') : Rule::unique('vendors','email')->ignore($this->vendor->id)],
            'category_id' => ['required','numeric',Rule::exists('categories','id')],
            'image' => [Rule::requiredIf(request()->method()=='POST'),'image'],
            'phone' => ['required',
                request()->method()=='POST'? Rule::unique('users','phone') : Rule::unique('users','phone')->ignore($this->vendor->user->id)],
//            'description_ar' => ['string'],
//            'address' => ['required'],
//            'description_en' => ['string'],
//            'tax' => ['numeric'],
        ];
    }
}
