<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if (\request()->ajax()){
            $coupons = $user->type == User::ADMIN ? Coupon::all() : Coupon::where('user_id',$user->id)->get();
            return DataTables::of($coupons)->make(true);
        }
        return view('dashboard.promoCodes.index');
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
    public function store(CouponRequest $request)
    {
        $data = $request->except(['_token']);
        $data['user_id'] = auth()->user()->id;
        Coupon::create($data);
        return response()->json(['success'=>'added successfully']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        if(!$coupon){
            return back()->with(['success'=>__('dashboard.no such data with this id')]);
        }
        return view('dashboard.promoCodes.edit',['promo'=>$coupon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        $coupon = Coupon::find($id);
        if(!$coupon){
            return back()->with(['success'=>__('dashboard.no such data with this id')]);
        }
        $data = $request->all();
        $data['active'] = $request->active=='on'?1:0;
        $coupon->update($data);
        return redirect()->route('admin.promoCodes.index')->with(['success'=>__('dashboard.item updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $coupon = Coupon::find($id);
        if(!$coupon){
            return back()->with(['success'=>__('dashboard.no such data with this id')]);
        }
        $coupon->delete();
        return back()->with(['success'=>__('dashboard.item deleted successfully')]);
    }

    public function changeStatus(Coupon $coupon)
    {
        $coupon->update(['active'=>!$coupon->active]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }
}
