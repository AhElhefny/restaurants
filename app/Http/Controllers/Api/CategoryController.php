<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index(){
        return response()->json([
            'success' => true,
            'message' => __('api.data retrieved successfully'),
            'data' => Category::where('active',1)->orderBy('id','DESC')->get()
        ],Response::HTTP_OK);
    }
}
