<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
use App\Http\services\ApiResponseTrait;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request){
        $query = Branch::with(['vendor'])->where('active',1);
        if ($request->category_id){
            $query->whereHas('vendor',function ($query)use ($request){
                $query->where('category_id',$request->category_id);
        });
        }
        if($request->filter){
            $query->whereHas('vendor',function ($query) use ($request){
                $query->where('name_ar','like','%'.$request->filter.'%')
                    ->orWhere('name_en','like','%'.$request->filter.'%')
                    ->orWhere('description_ar','like','%'.$request->filter.'%')
                    ->orWhere('description_en','like','%'.$request->filter.'%');
            })
                ->orWhere('name_ar','like','%'.$request->filter.'%')
                ->orWhere('name_en','like','%'.$request->filter.'%')
                ->orWhere('address','like','%'.$request->filter.'%')
                ->orWhere('phone','like','%'.$request->filter.'%');
        }
        if(isset($request->latitude) && isset($request->longitude)){
            $query = $query->select('*',DB::raw("6371 * acos(cos(radians(" . $request->latitude . "))
                * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $request->longitude . "))
                + sin(radians(" .$request->latitude. ")) * sin(radians(latitude))) AS distance"))->orderBy('distance','ASC');
        }
        $branches = $query->get();
        if($branches->count()>0){
            return $this->ApiResponse(true,__('api.data retrieved successfully'),200,BranchResource::collection($branches));
        }
        return $this->ApiResponse(true,__('api.no such this data'),200);

    }

    public function show(Branch $branch){
        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,new BranchResource($branch));
    }
}
