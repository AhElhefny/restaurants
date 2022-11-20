<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix'=>'auth','controller' => AuthController::class],function (){
    Route::post('verifyMobile','verifyMobile');
    Route::post('verifyOTP','verifyOTP');
    Route::post('register','register');
});

Route::get('categories',[CategoryController::class,'index']);

Route::group(['middleware'=>'auth:sanctum'],function (){

   Route::post('logout',[AuthController::class,'logout']);
});

