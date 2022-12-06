<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\services\HelperTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    use HelperTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user = auth()->user();
        $query = User::with(['bank_accounts','orders'])->where('type',User::USER);
        if (\request()->ajax()){
            $users = $auth_user->type != User::ADMIN ?$query->when($auth_user->type ==User::VENDOR,function ($q)use($auth_user){
                $q->whereHas('orders',function ($q)use($auth_user){
                   $q->whereIn('branch_id',$auth_user->vendor->branches->pluck('id')->toArray());
                });
            })->when($auth_user->type == User::BRANCH_MANAGER,function ($q)use($auth_user){
                $q->whereHas('orders',function ($q)use($auth_user){
                   $q->where('branch_id',$auth_user->branch->id);
                });
            })->get():$query->get();

            return DataTables::of($users)->make(true);
        }
        return view('dashboard.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $data = $request->except(['_token']);
        if($request->hasFile('image')){
            $data['image'] = $this->storeImage($request->file('image'),'users/users');
        }
        $data['password'] = bcrypt($request->password);
        $data['type'] = User::USER;
        $data['type_en'] = 'user';
        $data['type_ar'] = 'مستخدم';
        User::create($data);
        return redirect()->route('admin.customers.index')->with(['success'=>__('dashboard.item added successfully')]);
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

    /**
     * change status of the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(User $user){
        $user->update(['block' => !$user->block]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }
}
