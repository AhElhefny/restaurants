<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class AdditionsRequest extends FormRequest
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
            'name_ar' => ['required','min:3','max:100'],
            'name_en' => ['required','min:3','max:100'],
//            'slug' => ['required','min:3','max:55'],
            'min' => ['required','numeric'],
            'max' => ['nullable','numeric','min:'.request('min')],
            'price' => ['required','numeric'],
            'vendor_id' => ['required',Rule::exists('vendors','id')],
            'sub_category_id' => ['required',Rule::exists('vendor_categories','id')],
            'image' => ['nullable','image'],
        ];
    }
}
