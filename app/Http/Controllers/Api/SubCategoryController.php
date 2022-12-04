<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use App\Http\services\ApiResponseTrait;
use App\Models\Branch;
use App\Models\VendorCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request){
        $query = VendorCategory::with('vendor')->where('active',1);
        $branch = Branch::find($request->id);
        if($branch){
            $query->where('vendor_id',$branch->vendor_id);
        }
        $subCategories = $query->get();
        if($subCategories->count()>0){
            return $this->ApiResponse(true,__('api.data retrieved successfully'),200,SubCategoryResource::collection($subCategories));
        }
        return $this->ApiResponse(true,__('api.no such this data'),200);
    }
}
