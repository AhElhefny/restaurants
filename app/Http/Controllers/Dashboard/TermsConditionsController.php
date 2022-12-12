<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TermsConditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermsConditionsController extends Controller
{
    public function index(){
        $lang =\request()->route()->named('admin.terms.index_ar')?'ar':'en';
        return view('dashboard.terms_conditions.conditions_'.$lang,['terms'=>TermsConditions::first()]);
    }

    public function save(Request $request){

        if ($request->has('ar')&&$request->terms_ar == "<p><br></p>"){
            return back()->with(['success'=>__('dashboard.terms and conditions must not be empty')]);
        }elseif ($request->terms_en == "<p><br></p>"){
            return back()->with(['success'=>__('dashboard.terms and conditions must not be empty')]);
        }
        $lang = $request->has('ar')?'ar':'en';
        TermsConditions::updateOrCreate(
            [
                'slug' => $request->slug
            ],
            [
                'slug' => $request->slug,
                'terms_'.$lang => isset($request->terms_ar)?$request->terms_ar:$request->terms_en,
            ]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }
}
