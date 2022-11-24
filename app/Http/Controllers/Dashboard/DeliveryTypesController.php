<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DeliveryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DeliveryTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:delivery-types',['only'=>['index']]);
        $this->middleware('permission:add delivery-types',['only'=>['create','store']]);
        $this->middleware('permission:edit delivery-types',['only'=>['edit','update','changeStatus']]);
        $this->middleware('permission:delete delivery-types',['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->ajax()){
            $deliveryTypes = DeliveryType::all();
            return DataTables::of($deliveryTypes)->make(true);
        }
        return view('dashboard.deliveryType.index');
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
    public function store(Request $request)
    {
        $rules = [
          'type_ar' => ['required','min:3','max:100'],
          'type_en' => ['required','min:3','max:100'],
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return response()->json($validator->errors());
        }
        $data = $request->except(['_token']);
        $data['active'] = $request->active;
        DeliveryType::create($data);
        return response()->json(['success'=>true],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  DeliveryType  $deliveryType
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryType $deliveryType)
    {
        return view('dashboard.deliveryType.edit',['deliveryType'=>$deliveryType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  DeliveryType  $deliveryType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryType $deliveryType)
    {
        $rules = [
            'type_ar' => ['required','min:3','max:100'],
            'type_en' => ['required','min:3','max:100'],
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data = $request->except(['_token']);
        $data['active'] = $request->active == 'on' ? 1 : 0 ;
        $deliveryType->update($data);
        return redirect()->route('admin.deliveryTypes.index')->with(['success'=>__('dashboard.item updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeliveryType  $deliveryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryType $deliveryType)
    {
        $deliveryType->delete();
        return back()->with(['success'=>__('dashboard.item deleted successfully')]);
    }

    /**
     * change status of the specified resource from storage.
     *
     * @param  DeliveryType  $deliveryType
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(DeliveryType $deliveryType)
    {
        $deliveryType->update(['active'=>!$deliveryType->active]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }
}
