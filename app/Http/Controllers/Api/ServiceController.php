<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\services\ApiResponseTrait;
use App\Models\Branch;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request){
        $request->merge(['with_available'=>true]);
        if($request->branch_id){
            $branch = Branch::find($request->branch_id);
            if(!$branch){
                return $this->ApiResponse(false,__('api.no such this data'),401);
            }else{
                if ($request->subCategory){

                    $query = $branch->services->where('vendor_category_id',$request->subCategory);
                }else
                    $query = $branch->services;
            }

            return $this->ApiResponse(true,__('api.data retrieved successfully'),200,$query);
        }
        return $this->ApiResponse(false,__('api.no such this data'),401);
    }

    public function show(Service $service){
        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,new ServiceResource($service));
    }
}
