<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Models\Size;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sizes',['only'=>['index']]);
        $this->middleware('permission:add size',['only'=>['store']]);
        $this->middleware('permission:edit size',['only'=>['edit','update']]);
        $this->middleware('permission:delete size',['only'=>['destroy']]);
    }
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

        if(\request()->ajax()){
            if($user->type == User::ADMIN || $user->type == User::VENDOR){
                $sizes = $user->type == User::ADMIN ?
                    Size::with(['vendor','subCategories'])->get() :
                    Size::with(['vendor','subCategories'])->where('vendor_id',$user->vendor->id)->get();
            }else{
                $sizes =Size::with(['vendor','subCategories'])->where('vendor_id',$user->branch->vendor_id)->get();
            }
//            dd($sizes);
            return DataTables::of($sizes)->make(true);
        }
        return view('dashboard.vendorSetting.sizes.index',['vendors'=>$vendors]);
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
    public function store(SizeRequest $request)
    {
        $data = $request->except(['_token']);
        Size::create($data);
        return response()->json([
           'success' => true
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        $user =auth()->user();
        if($user->type == User::VENDOR || $user->type == User::BRANCH_MANAGER ){
            $vendors = Vendor::where('id',$user->type == User::VENDOR ?
                $user->vendor->id :
                $user->branch->vendor_id)->first() ;
        }elseif ($user->type == User::ADMIN){
            $vendors = Vendor::where('active',1)->get();
        }
        return  view('dashboard.vendorSetting.sizes.edit',['size'=>$size,'vendors'=>$vendors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(SizeRequest $request, Size $size)
    {
        $size->update($request->except(['_token']));
        return redirect()->route('admin.sizes.index')->with(['success' => __('dashboard.item updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return back()->with(['success'=>__('dashboard.item deleted successfully')]);
    }
}
