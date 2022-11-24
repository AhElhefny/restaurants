<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\services\HelperTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    use HelperTrait;

    public function __construct()
    {
        $this->middleware('permission:add category', ['only' => ['create','store']]);
        $this->middleware('permission:categories', ['only' => ['index']]);
        $this->middleware('permission:delete category', ['only' => ['destroy']]);
        $this->middleware('permission:edit category', ['only' => ['edit','update','change_status']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            return Datatables::of(Category::orderBy('id','DESC')->get())->make(true);
        }
        return view('dashboard.category.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->except('_token');
        $data['active'] = $request->active ? 1 : 0;
        $data['image'] = $this->storeImage($request->file('image'),'categories');
        Category::create($data);
        return redirect()->route('admin.category.index')->with(['success' => __('dashboard.item added successfully')]);
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
    public function edit(Category $category)
    {
        return view('dashboard.category.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data =$request->except('_token');
        $request->file('image')?$data['image']=$this->storeImage($request->file('image'),'categories'):'';
        $data['active'] = $request->active ? 1 : 0;
        $category->update($data);
        return redirect()->route('admin.category.index')->with(['success' => __('dashboard.item updated successfully')]);
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

    public function change_status(Category $category){

        $category->update(['active' => !$category->active]);
        return back()->with(['success' => __('dashboard.status changed successfully')]);
    }
}
