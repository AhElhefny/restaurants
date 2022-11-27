<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorCategory;
use App\Http\services\HelperTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubCategoryController extends Controller
{
    use HelperTrait;

    public function __construct()
    {
        $this->middleware('permission:sub-categories',['only'=>['index']]);
        $this->middleware('permission:add sub-category',['only'=>['store']]);
        $this->middleware('permission:show sub-category',['only'=>['show']]);
        $this->middleware('permission:edit sub-category',['only'=>['edit','update','changeStatus']]);
        $this->middleware('permission:delete sub-category',['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();
        if(\request()->ajax()){
            $query = VendorCategory::with('vendor');
            if ($user->type != User::ADMIN){
                $sub_categories = $query->where(function ($q)use($user){
                    $q->when($user->type == User::VENDOR,function($s) use($user){
                        $s->where('vendor_id',$user->vendor->id);
                    })->when($user->type != User::VENDOR,function($s) use($user){
                        $s->where('vendor_id',$user->branch->vendor_id);
                    });
                })->get();
            }else{
                $sub_categories = $query->get();
            }
            return DataTables::of($sub_categories)->make(true);
        }
        if($user->type == User::ADMIN || $user->type == User::VENDOR){
            $vendors = $user->type == User::ADMIN ? Vendor::all() : Vendor::find($user->vendor->id);
            return view('dashboard.vendorSetting.sub-categories.index',['vendors' => $vendors]);
        }
        return view('dashboard.vendorSetting.sub-categories.index');
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
    public function store(SubCategoryRequest $request)
    {
        $data = $request->except(['_token']);
        if($request->file('image')){
            $data['image'] = $this->storeImage($request->file('image'),'sub category');
        }
        $data['active'] = $request->active == 'on' ? 1 : 0 ;
        VendorCategory::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorCategory  $vendorCategory
     * @return \Illuminate\Http\Response
     */
    public function show(VendorCategory $vendorCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorCategory  $vendorCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory =VendorCategory::find($id);
        if (!$subcategory){
            return back()->with(['success' => 'no such that record']);
        }
        $user = auth()->user();
        $vendors = $user->type == User::ADMIN ? Vendor::all() : Vendor::find($user->vendor->id);
        return view('dashboard.vendorSetting.sub-categories.edit',['subCategory' => $subcategory,'vendors'=>$vendors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorCategory  $vendorCategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
    {
        $vendorCategory = VendorCategory::find($id);
        if(!$vendorCategory){
            return redirect()->route('admin.subCategories.index');
        }
        $data = $request->except(['_token']);
        $data['active'] = $request->active == 'on'?1:0;
        if($request->file('image')){
            $data['image'] = $this->storeImage($request->file('image'),'sub category');
        }
        $vendorCategory->update($data);
        return redirect()->route('admin.subCategories.index')->with(['success'=>__('dashboard.item updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorCategory  $vendorCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorCategory $vendorCategory)
    {
        //
    }

    /**
     * Change status of the specified resource from storage.
     *
     * @param  \App\Models\VendorCategory  $vendorCategory
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(VendorCategory $vendorCategory)
    {
        $vendorCategory->update(['active'=>!$vendorCategory->active]);
        return back();
    }

    public function get_sub_category_by_vendor(Request $request){
        return response()->json(VendorCategory::where('vendor_id',$request->vendor_id)->get());
    }
}
