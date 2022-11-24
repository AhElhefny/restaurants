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
            'image' => ['required','image'],
            'vendor_id' => ['required',Rule::exists('vendors','id')],
            //user data
            'name' => ['required','min:3','max:100'],
            'email' => ['required',Rule::unique('users','email')],
            'password' => ['required','confirmed','min:6','max:100'],
            'user_address' => ['required','min:5','max:255'],
            'userPhone' => ['required',Rule::unique('users','phone')],
            // delivery type data
            'deliveryTypes' => ['required','array'],
            'deliveryTypes.*' => [Rule::exists('delivery_types','id')]
        ];
    }
}
