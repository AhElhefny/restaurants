<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:orders',['only'=>['index']]);
        $this->middleware('permission:edit-order',['only'=>['edit']]);
        $this->middleware('permission:show-order',['only'=>['show']]);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if(\request()->ajax()){
            if($user->type != User::ADMIN){
                $branch_ids = $user->type == User::VENDOR ?
                    Branch::where('vendor_id',$user->vendor->id)->pluck('id')->toArray() :
                    [$user->branch->id];
                $orders = Order::with(['user','branch','orderStatus','paymentMethod'])->whereIn('branch_id', $branch_ids)->get();
            }else{
                $orders = Order::with(['user','branch','orderStatus','paymentMethod'])->get();
            }
            return DataTables::of($orders)->make(true);
        }
        return view('dashboard.orders.index');
    }

    public function show(Order $order){
        return view('dashboard.orders.details',['order'=>$order]);
    }

    public function changeStatus(Order $order){

    }
}
