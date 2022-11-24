<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Models\WorksTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class WorksTimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:works-time',['only'=>['index']]);
        $this->middleware('permission:add works-time',['only'=>['store']]);
        $this->middleware('permission:edit works-time',['only'=>['edit','update']]);
        $this->middleware('permission:delete works-time',['only'=>['destroy']]);
    }

    public function index(){
        $user = auth()->user();
        $vendors = $user->type == User::ADMIN ?
            Vendor::all() :
            Vendor::find($user->vendor->id);

        if(request()->ajax()){
            $worksTime = $user->type == User::ADMIN ?
                WorksTime::with(['vendor'])->get() :
                WorksTime::with(['vendor'])->where('vendor_id',$user->vendor->id)->get();
            return DataTables::of($worksTime)->make(true);
        }
        return view('dashboard.vendorSetting.worksTime.index',['vendors'=>$vendors]);
    }

    public function store(Request $request){
        $rules =[
          'from' => ['required'],
            'to' => ['required']
        ];
        $validator = Validator::make($request->except(['_token']),$rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data = $request->all();
        WorksTime::create($data);
        return back()->with(['success'=>__('dashboard.item added successfully')]);
    }

    public function edit(WorksTime $worksTime){
        $user = auth()->user();
        $vendors = $user->type == User::ADMIN ?
            Vendor::all() :
            Vendor::find($user->vendor->id);

        return view('dashboard.vendorSetting.worksTime.edit',['worksTime'=>$worksTime,'vendors'=>$vendors]);
    }

    public function update(Request $request,WorksTime $worksTime){
//        dd($request->all());
        $rules =[
            'from' => ['required'],
            'to' => ['required']//,'after_or_equal:from'
        ];
        $validator = Validator::make($request->except(['_token']),$rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data = $request->all();
        $worksTime->update($data);
        return redirect()->route('admin.worksTime.index')->with(['success'=>__('dashboard.item updated successfully')]);
    }

    public function destroy(WorksTime $worksTime){
        $worksTime->delete();
        return back()->with(['success'=>__('dashboard.item deleted successfully')]);
    }
}
