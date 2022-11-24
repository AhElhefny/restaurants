<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use App\Models\Service;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\services\HelperTrait;

class BranchController extends Controller
{
    use HelperTrait;
    public function __construct()
    {
        $this->middleware('permission:branches', ['only' => ['index']]);
        $this->middleware('permission:add branch', ['only' => ['create','store']]);
        $this->middleware('permission:delete branch', ['only' => ['destroy']]);
        $this->middleware('permission:edit branch', ['only' => ['edit','update','change_status']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.branches.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = auth()->user()->type == User::ADMIN ?
            Vendor::where('active',1)->get() :
            auth()->user()->vendor ;
        return view('dashboard.branches.add',['vendors' => $vendors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();
            $userData =[
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'address' =>  $request->address,
                'phone' => $request->userPhone,
                'type' => User::BRANCH_MANAGER,
                'type_ar' => 'مدير فرع',
                'type_en' =>'branch manager',
            ];
            $user = User::create($userData);
            $branchData =[
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'phone' => $request->phone,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'vendor_id' => $request->vendor_id,
                'range_of_delivery_price' => $request->range_of_delivery_price,
                'user_id' => $user->id,
                'active' => $request->active == 'on'? 1 : 0 ,
            ];
            if($request->hasFile('image')){
                $branchData['image'] = $this->storeImage($request->file('image'),'branches');
            }
            $branch =Branch::create($branchData);
            $branch->deliveryTypes()->attach($request->deliveryTypes);
            $services = Service::where('active',1)->get();
            $branch->services()->attach($services->pluck('id')->toArray());
            DB::commit();
            return redirect()->route('admin.branches.index')->with(['success'=>__('dashboard.item added successfully')]);
        }catch (\Exception $exception){
            return back()->with(['success'=>__('dashboard.something went wrong')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
