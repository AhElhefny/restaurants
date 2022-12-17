<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\services\HelperTrait;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    use HelperTrait;
    public function __construct()
    {
        $this->middleware('permission:offers',['only'=>['index']]);
        $this->middleware('permission:add offer',['only'=>['create','store']]);
        $this->middleware('permission:edit offer',['only'=>['update','edit','changeStatus']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $query = auth()->user()->type == User::ADMIN ? Offer::orderBy('id','DESC') : Offer::where(['active'=>1,'owner'=>auth()->user()->id]);
        $offers = $query->paginate(6);
        return view('dashboard.offers.index',['offers'=>$offers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.offers.add_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
          'title' => ['required','min:5'],
            'image' => ['required']
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data = $request->except(['_token']);
        $data['active'] = $request->active == 'on'?1:0;
        $data['owner'] = auth()->user()->id;
        if ($request->hasFile('image')){
            $data['image'] = $this->storeImage($request->file('image'),'offers');
        }
        Offer::create($data);
        return redirect()->route('admin.offers.index')->with(['success'=>__('dashboard.item added successfully')]);
    }

    /**
     * Display the specified resource.
     *
     * @param Offer $offer
     * @return Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Offer $offer
     * @return Response
     */
    public function edit(Offer $offer)
    {
        return view('dashboard.offers.add_edit',['offer'=>$offer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Offer $offer
     * @return Response
     */
    public function update(Request $request, Offer $offer)
    {
        $rules = [
            'title' => ['required','min:5'],
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $data = $request->except(['_token']);
        $data['active'] = $request->active == 'on'?1:0;
        if ($request->hasFile('image')){
            $data['image'] = $this->storeImage($request->file('image'),'offers');
        }
        $offer->update($data);
        return redirect()->route('admin.offers.index')->with(['success'=>__('dashboard.item updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Offer $offer
     * @return Response
     */
    public function destroy(Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Offer $offer
     * @return Response
     */
    public function changeStatus(Offer $offer)
    {
        $offer->update(['active' => !$offer->active]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }
}
