<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdditionsRequest;
use App\Http\services\HelperTrait;
use App\Models\Addition;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdditionController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =auth()->user();
        if($user->type == User::VENDOR || $user->type == User::BRANCH_MANAGER ){
            $vendors = Vendor::where('id',$user->type == User::VENDOR ?
                $user->vendor->id :
                $user->branch->vendor_id)->first() ;
        }elseif ($user->type == User::ADMIN){
            $vendors = Vendor::where('active',1)->get();
        }

        $query = Addition::with(['vendor','vendorCategory']);
        if(\request()->ajax()){
                $additions = $user->type == User::ADMIN ?
                    $query->get() :
                    $query->where('vendor_id',$user->type == User::VENDOR ?
                        $user->vendor->id :
                        $user->branch->vendor_id)->get();
            return DataTables::of($additions)->make(true);
        }
        return view('dashboard.vendorSetting.additions.index',['vendors'=>$vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdditionsRequest $request)
    {
        $data = $request->except(['_token','image','active']);
        $data['active'] = $request->active == 'on' ? 1 : 0 ;
        $data['vendor_category_id'] = $request->sub_category_id;
        if($request->hasFile('image')){
            $data['image'] = $this->storeImage($request->file('image'),'additions');
        }
        Addition::create($data);
        return back()->with(['success'=>__('dashboard.item added successfully')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Addition  $addition
     * @return \Illuminate\Http\Response
     */
    public function show(Addition $addition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Addition  $addition
     * @return \Illuminate\Http\Response
     */
    public function edit(Addition $addition)
    {
        $user =auth()->user();
        if($user->type == User::VENDOR || $user->type == User::BRANCH_MANAGER ){
            $vendors = Vendor::where('id',$user->type == User::VENDOR ?
                $user->vendor->id :
                $user->branch->vendor_id)->first() ;
        }elseif ($user->type == User::ADMIN){
            $vendors = Vendor::where('active',1)->get();
        }
        return view('dashboard.vendorSetting.additions.edit',['addition'=>$addition,'vendors'=>$vendors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Addition  $addition
     * @return \Illuminate\Http\Response
     */
    public function update(AdditionsRequest $request, Addition $addition)
    {
        $data = $request->except(['_token','image','active']);
        $data['active'] = $request->active == 'on' ? 1 : 0 ;
        $data['vendor_category_id'] = $request->sub_category_id;
        if($request->hasFile('image')){
            $data['image'] = $this->storeImage($request->file('image'),'additions');
        }
        $addition->update($data);
        return redirect()->route('admin.addition.index')->with(['success'=>__('dashboard.item updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Addition  $addition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Addition $addition)
    {
        //
    }

    /**
     * change Status of the specified resource from storage.
     *
     * @param  \App\Models\Addition  $addition
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Addition $addition)
    {
        $addition->update(['active'=>!$addition->active]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }
}
