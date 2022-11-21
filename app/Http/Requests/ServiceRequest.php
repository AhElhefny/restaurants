<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
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
            'name_ar' => ['required','min:3','max:191'],
            'name_en' => ['required','min:3','max:191'],
            'description_ar' => ['required','min:5',],
            'description_en' => ['required','min:5',],
            'vendor_id' => ['required',Rule::exists('vendors','id')],
            'sub_category_id' => ['required',Rule::exists('vendor_categories','id')],
            'image' => [Rule::requiredIf(request()->method()=='POST')]
        ];
    }
}
