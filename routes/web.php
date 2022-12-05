<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BankController;
use App\Http\Controllers\Dashboard\BranchController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DeliveryTypesController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\PaymentMethodsControllr;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\SizeController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use App\Http\Controllers\Dashboard\VendorController;
use App\Http\Controllers\Dashboard\WorksTimeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', function () {
        return view('front.home');
    });

//    Route::fallback(function (){
//        return redirect()->route('admin.home');
//    });

    Route::group(['prefix' => 'admin'],function (){
        Route::name('admin.')->group(function (){

            Route::get('',[AuthController::class,'index'])->name('login')->middleware('guest');
            Route::post('', [AuthController::class, 'login'])->name('startSession');

            Route::group(['middleware' => 'auth'],function (){
                Route::view('home','dashboard.index')->name('home');
                Route::get('destroy',[AuthController::class,'logout'])->name('logout');

                Route::resource('category',CategoryController::class);
                Route::get('category/{category}/changeStatus',[CategoryController::class,'change_status'])->name('change_category_status');

                Route::resource('roles', RolesController::class);
                Route::post('permission/add',[RolesController::class,'add_permission'])->name('add_permission');

                Route::resource('vendors',VendorController::class);
                Route::get('vendors/{vendor}/changeStatus',[VendorController::class,'changeStatus']);

                Route::resource('branches',BranchController::class);
                Route::get('branches/{branch}/changeStatus',[BranchController::class,'changeStatus']);

                Route::resource('sizes',SizeController::class);
                Route::get('sizesForSubCat',[SizeController::class,'gettingSizesAccordingToSubCategory'])->name('sizes.getSizesForSubCategory');

                Route::resource('services',ServiceController::class);
                Route::get('service/{service}/changeStatus',[ServiceController::class,'changeStatus'])->name('change_service_status');

                Route::resource('subCategories',SubCategoryController::class);
                Route::get('subCategories/{vendorCategory}/changeStatus',[SubCategoryController::class,'changeStatus']);
                Route::get('vendor/subCategories',[SubCategoryController::class,'get_sub_category_by_vendor'])->name('vendors.sub_categories');

                Route::resource('deliveryTypes',DeliveryTypesController::class);
                Route::get('deliveryTypes/{deliveryType}/changeStatus',[DeliveryTypesController::class,'changeStatus'])->name('change_deliveryTypes_status');

                Route::resource('worksTime',WorksTimeController::class);

                Route::get('orders',[OrdersController::class,'index'])->name('orders.index');
                Route::get('order/{order}',[OrdersController::class,'show'])->name('orders.show');
                Route::get('order/{order}/changeStatus',[OrdersController::class,'changeStatus'])->name('orders.changeStatus');

                Route::get('bankAccounts',[BankController::class,'index'])->name('bank.index');
                Route::get('bank/{bank}/changeStatus',[BankController::class,'change_status']);

                Route::resource('payment_methods',PaymentMethodsControllr::class)->except(['create','destroy']);
                Route::get('payment_methods/{method}/changeStatus',[PaymentMethodsControllr::class,'changeStatus']);
            });
        });
    });
});
