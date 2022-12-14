<?php


use App\Http\Controllers\Dashboard\AdditionController;
use App\Http\Controllers\Dashboard\AppNotificationController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BankController;
use App\Http\Controllers\Dashboard\BranchController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ContactUsController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\DeliveryManController;
use App\Http\Controllers\Dashboard\DeliveryTypesController;
use App\Http\Controllers\Dashboard\NotificationsController;
use App\Http\Controllers\Dashboard\OfferController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\PaymentMethodsControllr;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\SizeController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use App\Http\Controllers\Dashboard\TermsConditionsController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\VendorController;
use App\Http\Controllers\Dashboard\WorksTimeController;
use App\Http\Controllers\HomeController;
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

            Route::group(['controller'=>AuthController::class],function(){
                Route::get('','index')->name('login')->middleware('guest');
                Route::post('','login')->name('startSession');
            });

            Route::group(['middleware' => 'auth'],function (){
                Route::get('home',[HomeController::class,'index'])->name('home');
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
                Route::post('service/{service}/additions',[ServiceController::class,'serviceAdditions'])->name('services.serviceAdditions');

                Route::resource('subCategories',SubCategoryController::class);
                Route::get('subCategories/{vendorCategory}/changeStatus',[SubCategoryController::class,'changeStatus']);
                Route::get('vendor/subCategories',[SubCategoryController::class,'get_sub_category_by_vendor'])->name('vendors.sub_categories');

                Route::resource('deliveryTypes',DeliveryTypesController::class);
                Route::get('deliveryTypes/{deliveryType}/changeStatus',[DeliveryTypesController::class,'changeStatus'])->name('change_deliveryTypes_status');

                Route::resource('worksTime',WorksTimeController::class);

                Route::get('orders',[OrdersController::class,'index'])->name('orders.index');
                Route::get('order/{order}',[OrdersController::class,'show'])->name('orders.show');
                Route::get('order/{order}/invoice',[OrdersController::class,'invoice'])->name('orders.invoice');
                Route::get('order/{order}/editPaySetting',[OrdersController::class,'editPaySetting'])->name('orders.editPaySetting');
                Route::get('order/{order}/changeStatus',[OrdersController::class,'changeStatus'])->name('orders.changeStatus');

                Route::get('bankAccounts',[BankController::class,'index'])->name('bank.index');
                Route::get('bank/{bank}/changeStatus',[BankController::class,'change_status']);

                Route::resource('payment_methods',PaymentMethodsControllr::class)->except(['create','destroy']);
                Route::get('payment_methods/{method}/changeStatus',[PaymentMethodsControllr::class,'changeStatus']);

                Route::resource('customers',UserController::class)->except(['edit','update','destroy']);
                Route::get('customers/{user}/changeStatus',[UserController::class,'changeStatus']);
                Route::get('users',[UserController::class,'users'])->name('users.getUsers');
                Route::get('admins',[UserController::class,'admin_index'])->name('admins.index');
                Route::get('admins/create',[UserController::class,'admin_create'])->name('admins.create');
                Route::post('admins/store',[UserController::class,'admin_store'])->name('admins.store');
                Route::get('admins/{admin}/edit',[UserController::class,'admin_edit'])->name('admins.edit');
                Route::put('admins/{admin}/update',[UserController::class,'admin_update'])->name('admins.update');
                Route::get('admins/{admin}/changeStatus',[UserController::class,'admin_changeStatus'])->name('admins.changeStatus');

                Route::get('contact-us',[ContactUsController::class,'index'])->name('contact.index');
                Route::delete('contact-us/{contactUs}',[ContactUsController::class,'destroy'])->name('contact.destroy');

                Route::get('terms/ar',[TermsConditionsController::class,'index'])->name('terms.index_ar');
                Route::get('terms/en',[TermsConditionsController::class,'index'])->name('terms.index_en');
                Route::post('terms',[TermsConditionsController::class,'save'])->name('terms.save');

                Route::resource('promoCodes',CouponController::class);
                Route::get('promoCodes/{coupon}/changeStatus',[CouponController::class,'changeStatus'])->name('promoCodes.changeStatus');

                Route::get('deliveryMen',[DeliveryManController::class,'index'])->name('deliveryMen.index');
                Route::get('deliveryMen/{id}/show',[DeliveryManController::class,'show'])->name('deliveryMen.show');
                Route::get('deliveryMen/requests',[DeliveryManController::class,'requests'])->name('deliveryMen.requests');
                Route::get('deliveryMen/{deliveryman}/edit/{status}',[DeliveryManController::class,'requestStatus'])->name('deliveryMen.requestStatus');

                Route::resource('offers',OfferController::class);
                Route::get('offers/{offer}/changeStatus',[OfferController::class,'changeStatus'])->name('offers.changeStatus');

                Route::view('app_notifications','dashboard.app_notifications')->name('appNotifications.index');
                Route::post('app_notifications',AppNotificationController::class)->name('appNotifications.send');
                Route::get('profile',[AuthController::class,'profile'])->name('profile');
                Route::put('profile/{user}/update',[AuthController::class,'update_profile'])->name('users.update.profile');
                Route::post('profile/bank/store',[BankController::class,'store_from_profile'])->name('users.bank_profile.store');
                Route::delete('profile/{bank}/delete',[BankController::class,'destroy_from_profile'])->name('users.bank_profile.destroy');
                Route::get('profile/{bank}/edit',[BankController::class,'edit_from_profile'])->name('users.bank_profile.edit');
                Route::put('profile/{bank}/update/bank',[BankController::class,'update_from_profile'])->name('users.bank_profile.update');

                Route::get('notifications/read-all',[NotificationsController::class,'readAll'])->name('notifications.read_all');
                Route::get('notifications/{notification}/read',[NotificationsController::class,'read'])->name('notifications.read');
                Route::patch('/fcm-token', [NotificationsController::class, 'updateToken'])->name('fcmToken');

                Route::resource('addition',AdditionController::class);
                Route::get('addition/{addition}/changeStatus',[AdditionController::class,'changeStatus'])->name('addition.changeStatus');
            });
        });
    });
});

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
