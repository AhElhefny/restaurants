<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\services\ApiResponseTrait;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $data =Category::where('active',1)->orderBy('id','DESC')->get();
        return $this->ApiResponse(true,__('api.data retrieved successfully'),Response::HTTP_OK,$data);
    }
}
