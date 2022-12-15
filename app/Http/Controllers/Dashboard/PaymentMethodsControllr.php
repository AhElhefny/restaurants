<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\services\HelperTrait;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use function Symfony\Component\Translation\t;

class PaymentMethodsControllr extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:payment-methods',['only'=>['index']]);
        $this->middleware('permission:add payment-methods',['only'=>['store']]);
        $this->middleware('permission: edit payment-methods',['only'=>['edit','update','changeStatus']]);
    }

    use HelperTrait;
    public function index(){
        if (\request()->ajax()){
            $methods = PaymentMethod::all();
            return DataTables::of($methods)->make(true);
        }
        return view('dashboard.banks.payment_methods.index');
    }

    public function edit(PaymentMethod $paymentMethod){
        return view('dashboard.banks.payment_methods.index',['method'=>$paymentMethod]);
    }

    public function store(Request $request){
        $rules = [
          'method_ar' =>['required','min:3'],
          'method_en' =>['required','min:3'],
        ];
        $validator = Validator::make($request->except('_token'),$rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data =$request->except('_token');
        if($request->hasFile('icon')){
            $data['icon'] = $this->storeImage($request->file('icon'),'payment_method');
        }
        $data['active'] = $request->active =='on'? 1 : 0 ;
        PaymentMethod::create($data);
        return back()->with(['success'=>__('dashboard.item added successfully')]);
    }

    public function update(PaymentMethod $paymentMethod,Request $request){
        $rules = [
            'method_ar' =>['required','min:3'],
            'method_en' =>['required','min:3'],
        ];
        $validator = Validator::make($request->except('_token'),$rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data =$request->except('_token');
        if($request->hasFile('icon')){
            $data['icon'] = $this->storeImage($request->file('icon'),'payment_method');
        }
        $data['active'] = $request->active =='on'? 1 : 0 ;
        $paymentMethod->update($data);
        return redirect()->route('admin.payment_methods.index')->with(['success'=>__('dashboard.item updated successfully')]);
    }

    public function changeStatus(PaymentMethod $method){
        $method->update(['active'=>!$method->active]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }
}
