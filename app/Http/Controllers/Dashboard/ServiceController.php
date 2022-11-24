<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Models\User;
use App\Models\Vendor;
use App\Http\services\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    use HelperTrait;
    public function __construct()
    {
        $this->middleware('permission:services',['only'=>['index']]);
        $this->middleware('permission:add service',['only'=>['create','store']]);
        $this->middleware('permission:edit service',['only'=>['edit','update','changeStatus']]);
        $this->middleware('permission:delete service',['only'=>['destroy']]);
        $this->middleware('permission:show service',['only'=>['show']]);
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

        $query = Service::with(['vendor','vendorCategory']);
        if(\request()->ajax()){
            if($user->type == User::ADMIN || $user->type == User::VENDOR){
                $services = $user->type == User::ADMIN ?
                    $query->get() :
                    $query->where('vendor_id',$user->vendor->id)->get();
            }else{
                $services =$query->where('vendor_id',$user->branch->vendor_id)->get();
            }
            return DataTables::of($services)->make(true);
        }
        return view('dashboard.vendorSetting.services.index',['vendors'=>$vendors]);
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
    public function store(ServiceRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except(['_token']);
            $data['active'] = $request->active == 'on' ? 1 : 0 ;
            $data['vendor_category_id'] = $request->sub_category_id;
            if($request->file('image')){
                $data['image'] = $this->storeImage($request->file('image'),'services');
            }
            $service = Service::create($data);
            $services['price'] = $request->price;
            $sizes_ids = array_keys($request->sizes);
            foreach ($sizes_ids as $id){
                $size_id = $id;
                $price = $services['price'][$id];
                $service->sizes()->attach($size_id,['price'=>$price,'active'=>$data['active']]);
            }
            DB::commit();
            return back()->with(['success' => __('dashboard.item added successfully')]);
        }catch (\Exception $exception){
            DB::rollBack();
            return back()->with(['success' => __('dashboard.something went wrong')]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $user =auth()->user();
        if($user->type == User::VENDOR || $user->type == User::BRANCH_MANAGER ){
            $vendors = Vendor::where('id',$user->type == User::VENDOR ?
                $user->vendor->id :
                $user->branch->vendor_id)->first() ;
        }elseif ($user->type == User::ADMIN){
            $vendors = Vendor::where('active',1)->get();
        }
        return view('dashboard.vendorSetting.services.edit',['vendors'=>$vendors,'service'=>$service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $data = $request->except(['_token']);
        $data['active'] = $request->active == 'on' ? 1 : 0 ;
        if ($request->hasFile('image')){
            $data['image'] = $this->storeImage($request->file('image'),$service->folder);
        }
        $data['vendor_category_id'] = $request->sub_category_id;
        $service->update($data);
        return redirect()->route('admin.services.index')->with(['success'=>__('dashboard.item updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
//      unlink(asset('dashboardAssets/images/'.$service->folder.'/'.$service->image));
        $service->delete();
        return back()->with(['success'=>__('dashboard.item deleted successfully')]);
    }

    /**
     * change status of the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Service $service)
    {
        $service->update(['active'=>!$service->active]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }
}
