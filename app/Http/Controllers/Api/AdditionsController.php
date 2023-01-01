<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdditionsResource;
use App\Http\services\ApiResponseTrait;
use App\Models\Addition;
use App\Models\Branch;
use Illuminate\Http\Request;

class AdditionsController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request){
        if($request->branch_id){
            $branch = Branch::find($request->branch_id);
            if(!$branch){
                return $this->ApiResponse(false,__('api.no such this data'),401);
            }else{
                if ($request->subCategory){

                    $query = $branch->vendor->additions->where('vendor_category_id',$request->subCategory);
                }else
                    $query = $branch->vendor->additions;
            }
            $slugs = $query->pluck('slug')->toArray();
            $slugs = array_unique($slugs);
            foreach ($slugs as $key=>$slug){
                $q[$key]['slug'] = $slug;
                $q[$key]['min'] = $query->where('slug',$slug)->pluck('min')->toArray()[0];
                $q[$key]['max'] = $query->where('slug',$slug)->pluck('max')->toArray()[0];
                $q[$key]['additions'] = $query->where('slug',$slug);
            }
            return $this->ApiResponse(true,__('api.data retrieved successfully'),200,$q);
        }
        return $this->ApiResponse(false,__('api.no such this data'),401);
    }
}
