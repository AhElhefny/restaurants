<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    protected $lang ;
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
            'name_ar' => ['required','min:5',
                request()->method()=='POST'?
                    Rule::unique('categories','name_ar') : Rule::unique('categories','name_ar')->ignore($this->category->id)],
            'name_en' => ['required','min:5',
                request()->method()=='POST'?
                    Rule::unique('categories','name_en') : Rule::unique('categories','name_en')->ignore($this->category->id)],
            'description_ar' => ['required','min:10',],
            'description_en' => ['required','min:10',],
            'image' => [Rule::requiredIf(request()->method()=='POST'),'image','nullable'],
        ];
    }
}
