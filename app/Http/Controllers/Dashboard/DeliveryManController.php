<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMan;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeliveryManController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:delivery-man',['only'=>['index','requests']]);
        $this->middleware('permission:edit delivery-man',['only'=>['requestStatus']]);
        $this->middleware('permission:show delivery-man',['only'=>['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->ajax()){
            $men = DeliveryMan::with(['user','company'])->where('account_status','!=',(string)DeliveryMan::PENDING)->get();
            return DataTables::of($men)->make(true);
        }
        return view('dashboard.users.delivery_men.index');
    }

    public function requests()
    {
        if (\request()->ajax()){
            $men = DeliveryMan::with(['user','company'])->where('account_status','=',(string)DeliveryMan::PENDING)->get();
            return DataTables::of($men)->make(true);
        }
        return view('dashboard.users.delivery_men.requests');
    }

    public function requestStatus($id,$status){
        $delivery_man = DeliveryMan::find($id);
        if(!$delivery_man){
            return back()->with(['success'=>__('dashboard.no such data with this id')]);
        }
        $delivery_man->update(['account_status'=>$status]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delivery_man_user = User::find($id);
        $delivery_man = $delivery_man_user->deliveryMan;
        if(!$delivery_man){
            return back()->with(['success'=>__('dashboard.no such data with this id')]);
        }
        return view('dashboard.users.delivery_men.details',['man'=>$delivery_man_user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
