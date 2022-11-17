<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Http\services\HelperTrait;
use App\Models\Category;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
use HelperTrait;
    public function __construct()
    {
        $this->middleware('permission:vendors',['only'=>['index']]);
        $this->middleware('permission:add vendor',['only'=>['create','store']]);
        $this->middleware('permission:edit vendor',['only'=>['edit','update','changeStatus']]);
        $this->middleware('permission:delete vendor',['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\request()->ajax()){
            $data = Vendor::with(['category','user'])->get();
            return Datatables::of($data)->make(true);

        }
        return view('dashboard.vendors.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.vendors.add',['category' => Category::where('active',1)->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VendorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {
        try {
            DB::beginTransaction();
            // store data of vendor into users table
            $data['name'] = $request->name_en;
            $data['email'] = $request->email;
            $data['password'] = bcrypt($request->password);
            $data['type'] = User::VENDOR;
            $data['type_ar'] = 'مزود خدمه';
            $data['type_en'] = 'vendor';
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
            $data['longitude'] = $request->longitude ? : 0;
            $data['latitude'] = $request->latitude ? : 0;
            if ($request->file('image')){
                $data['image'] = $this->storeImage($request->file('image'),'users/vendors');
            }
            $user = User::create($data);

            // store data of vendor into vendors table
            $vendor['name_ar'] = $request->name_ar;
            $vendor['name_en'] = $request->name_en;
            $vendor['description_ar'] = $request->description_ar;
            $vendor['description_en'] = $request->description_en;
            $vendor['active'] = $request->active ? 1: 0;
            $vendor['email'] = $user->email;
            $vendor['tax'] = $request->tax;
            $vendor['category_id'] = $request->category_id;
            $vendor['user_id'] = $user->id;
            Vendor::create($vendor);
            $user->assignRole('vendor');
            DB::commit();
            return redirect()->route('admin.vendors.index')->with(['success' => __('dashboard.item added successfully')]);
        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('dashboard.vendors.details',['vendor' => $vendor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('dashboard.vendors.edit',[
            'vendor'=>$vendor,
            'category' => Category::where('active',1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\VendorRequest  $request
     * @param  Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, Vendor $vendor)
    {
        try {
            DB::beginTransaction();
            // store data of vendor into users table
            $data['name'] = $request->name_en;
            $data['email'] = $request->email;
            $data['password'] = bcrypt($request->password);
            $data['type'] = User::VENDOR;
            $data['type_ar'] = 'مزود خدمه';
            $data['type_en'] = 'vendor';
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
            $data['longitude'] = $request->longitude ? : 0;
            $data['latitude'] = $request->latitude ? : 0;
            if ($request->file('image')){
                $data['image'] = $this->storeImage($request->file('image'),'users/vendors');
            }
            $vendor->user->update($data);

            // store data of vendor into vendors table
            $data['name_ar'] = $request->name_ar;
            $data['name_en'] = $request->name_en;
            $data['description_ar'] = $request->description_ar;
            $data['description_en'] = $request->description_en;
            $data['active'] = $request->active ? 1: 0;
            $data['email'] = $request->email;
            $data['tax'] = $request->tax;
            $data['category_id'] = $request->category_id;
            $vendor->update($data);
            DB::commit();
            return redirect()->route('admin.vendors.index')->with(['success' => __('dashboard.item updated successfully')]);
        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //TODO
        //check if its branches have orders or not and order must be completed to remove the vendor
    }

    /**
     * change state of the specified resource from storage.
     *
     * @param  Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Vendor $vendor){
        $vendor->update([
           'active' => !$vendor->active
        ]);
        return back()->with(['success' => __('dashboard.status changed successfully')]);
    }
}
