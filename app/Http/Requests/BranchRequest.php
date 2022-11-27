<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
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
            // branch data
            'name_en' => ['required','min:3','max:255'],
            'name_ar' => ['required','min:3','max:255'],
            'phone' => ['required','digits:9'],
            'address' => ['required','min:5','max:255'],
            'image' => request()->method() == 'POST'?['required','image']:'',
            'vendor_id' => ['required',Rule::exists('vendors','id')],
            //user data
            'name' => ['required','min:3','max:100'],
            'email' => ['required',request()->method()=='POST'?Rule::unique('users','email'):Rule::unique('users','email')->ignore($this->branch->user->id)],
            'password' => request()->method()=='POST'?['required','confirmed','min:6','max:100']:['confirmed'],
            'user_address' => ['required','min:5','max:255'],
            'userPhone' => ['required',request()->method()=='POST'?Rule::unique('users','phone'):Rule::unique('users','phone')->ignore($this->branch->user->id)],
            // delivery type data
            'deliveryTypes' => ['required','array'],
            'deliveryTypes.*' => [Rule::exists('delivery_types','id')]
        ];
    }
}
