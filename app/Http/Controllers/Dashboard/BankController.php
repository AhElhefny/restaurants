<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bank;
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
}
