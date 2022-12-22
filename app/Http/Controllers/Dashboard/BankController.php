<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:bank-accounts',['only'=>['index']]);
    }

    public function index(){
        if(request('filter'))
        {
            $userType = request('filter');
        }
        $userType = $userType??'vendor';

        $accounts = Bank::with('user')->whereHas('user',function ($q)use($userType){
           return $q->where('type_en',$userType);
        })->get();
        if (\request()->ajax()){

            return Datatables::of($accounts)->make(true);
        }
        return view('dashboard.banks.index');
    }

    public function change_status(Bank $bank){
        $bank->update(['active'=>!$bank->active]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }

    public function store_from_profile(Request $request){
        $rules = [
            'bank_name' => ['required'],
            'account_number' => ['required'],
            'IBAN' => ['required'],
        ];
        $validator = Validator::make($request->except(['_token']),$rules);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data =$request->except(['_token']);
        $user = auth()->user();
        $user->bank_accounts()->create($data);
        return back()->with(['success'=>__('dashboard.item added successfully')]);
    }

    public function destroy_from_profile(Bank $bank){
        $bank->delete();
        return back()->with(['success'=>__('dashboard.item deleted successfully')]);
    }

    public function edit_from_profile(Bank $bank){
        return response()->json($bank);
    }

    public function update_from_profile(Request $request,Bank $bank){
        $rules = [
            'E_bank_name' => ['required'],
            'E_account_number' => ['required'],
            'E_IBAN' => ['required'],
        ];
        $validator = Validator::make($request->except(['_token']),$rules);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data['bank_name'] = $request->E_bank_name;
        $data['account_number'] = $request->E_account_number;
        $data['name_on_card'] = $request->E_name_on_card;
        $data['IBAN'] = $request->E_IBAN;
        $bank->update($data);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }
}
