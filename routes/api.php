<?php

use App\Http\Controllers\Api\AdditionsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DeliveryTypesControllr;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentMethodsControllr;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SubCategoryController;
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
Route::get('branches',[BranchController::class,'index']);
Route::get('branch/{branch}/show',[BranchController::class,'show']);
Route::get('sub_categories',[SubCategoryController::class,'index']);
Route::get('services',[ServiceController::class,'index']);
Route::get('service/{service}/show',[ServiceController::class,'show']);
Route::get('delivery_types',DeliveryTypesControllr::class);
Route::get('payment_methods',PaymentMethodsControllr::class);
Route::get('additions',[AdditionsController::class,'index']);

Route::group(['prefix'=>'cart','controller'=>CartController::class],function (){
    Route::post('service/add','AddToCart');
    Route::post('empty','ClearCart');
    Route::post('items','CartItems');
    Route::post('remove/item','RemoveFromCart');
    Route::post('update/item','UpdateItem');
});


Route::group(['middleware'=>'auth:sanctum'],function (){
   Route::post('logout',[AuthController::class,'logout']);
   Route::post('FCMToken/store',[NotificationsController::class,'storeFCMToken']);
   Route::get('user/notifications',[NotificationsController::class,'index']);
   Route::get('user/cart',[CartController::class,'UserCart']);
   Route::get('addCartToUser/{cart}',[CartController::class,'AddCartToUser']);
   Route::controller(OrderController::class)->group(function (){
       Route::get('orders','index');
       Route::get('promoCode/validation','checkPromoCode');
       Route::group(['prefix' => 'order'],function (){
           Route::get('{order}','show');
           Route::post('{order}/changeState','changeStatus');
           Route::post('store','store');
       });
   });

});

