<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\services\HelperTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use function Symfony\Component\String\b;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users',['only'=>['index']]);
        $this->middleware('permission:add user',['only'=>['create','store']]);
        $this->middleware('permission:show user',['only'=>['show']]);
        $this->middleware('permission:edit user',['only'=>['changeStatus']]);
        $this->middleware('permission:admins',['only'=>['admin_index']]);
        $this->middleware('permission:add admin',['only'=>['admin_create','admin_store']]);
        $this->middleware('permission:edit admin',['only'=>['admin_changeStatus','admin_edit','admin_update']]);
//        $this->middleware('permission:delete admin',['only'=>['']]);
//        $this->middleware('permission:delete user',['only'=>['']]);
    }

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
        if ($id){
            $user =User::find($id);
        }
        if(!$user){
            return back()->with(['success'=>__('dashboard.no such data with this id')]);
        }
        return view('dashboard.users.view',['customer'=>$user]);
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

    public function admin_index(){
        if(\request()->ajax()){
            $admins = User::with(['roles'])->where('type',User::ADMIN)->get();
            return DataTables::of($admins)->make(true);
        }
        return view('dashboard.users.admins.index');
    }

    public function admin_create(){
        return view('dashboard.users.admins.add_edit');
    }

    public function admin_store(Request $request){
        $rules = [
          'role' => ['required',Rule::exists('roles','name')],
          'name' => ['required','min:3','max:100'],
          'email' => ['required',Rule::unique('users','email')],
          'phone' => ['required','digits:9'],
          'password' => ['required','confirmed','min:6','max:100']
        ];
        $validator = Validator::make($request->except(['_token']),$rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data = $request->except(['_token']);
        if ($request->hasFile('image')){
            $data['image'] = $this->storeImage($request->file('image'),'users/admins');
        }
        $data['password'] = bcrypt($request->password);
        $data['type'] = User::ADMIN;
        $data['type_ar'] = 'مسؤول التطبيق';
        $data['type_en'] = 'admin';
        $admin =User::create($data);
        $admin->assignRole($request->role);
        return redirect()->route('admin.admins.index')->with(['success'=>__('dashboard.item added successfully')]);
    }

    public function admin_changeStatus($id){
        $admin = User::find($id);
        if($admin){
            $admin->update(['block'=>!$admin->block]);
            return back()->with(['success'=>__('dashboard.item updated successfully')]);
        }
        return back()->with(['success'=>__('dashboard.no such data with this id')]);
    }

    public function admin_edit($id){
        $admin =User::find($id);
        if($admin){
            return view('dashboard.users.admins.add_edit',['admin'=>$admin]);
        }
        return back()->with(['success'=>__('dashboard.no such data with this id')]);
    }

    public function admin_update(Request $request,$id){
        $rules = [
            'role' => ['required',Rule::exists('roles','name')],
            'name' => ['required','min:3','max:100'],
            'email' => ['required',Rule::unique('users','email')->ignore($id)],
            'phone' => ['required','digits:9'],
            'password' => ['confirmed','nullable','min:6','max:100']
        ];
        $validator = Validator::make($request->except(['_token']),$rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data = $request->except(['_token']);
        if ($request->hasFile('image')){
            $data['image'] = $this->storeImage($request->file('image'),'users/admins');
        }
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $admin = User::find($id);
        if($admin){
            $admin->update($data);
            $admin->syncRoles([$request->role]);
            return redirect()->route('admin.admins.index')->with(['success'=>__('dashboard.item added successfully')]);
        }
        return back()->with(['success'=>__('dashboard.no such data with this id')]);
    }

    public function users(){
        return response()->json(User::where(['block'=>0,'type'=>User::USER])->get(),200);
    }
}
