<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\services\ApiResponseTrait;
use App\Http\services\pushTrait;
use App\Models\Addition;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\FcmToken;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\OrderStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use ApiResponseTrait,pushTrait;
    public function index(Request $request){
        $query = Order::where('user_id',auth()->user()->id);
        if ($request->has('status')){
            $query->where('order_status_id',$request->status);
        }
        $orders = $query->get();

        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,OrderResource::collection($orders));
    }

    public function show(Order $order){
        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,new OrderResource($order));
    }

    public function changeStatus(Request $request, Order $order){
        $newState = OrderStatus::find($request->status);
        $oldState = $order->orderStatus;
        if (!$newState){
            return $this->ApiResponse(false,__('api.no such this data'),404);
        }
        $order->update(['order_status_id'=>$request->status]);

        $data['title_ar'] = 'لقد تم تغيير حاله طلبكم';
        $data['title_en'] = 'Order State had changed';
        $data['body_ar'] = ' لقد تم تغيير حاله طلبكم من ' . $oldState->name_ar . ' الي ' . $newState->name_ar;
        $data['body_en'] = 'Your order State had changed from '. $oldState->name_en . ' to '. $newState->name_en;
        $data['order_id'] = $order->id;
        $data['user_id'] = $order->user_id;
        $notification = Notification::create($data);

        $userToken = FcmToken::where('user_id',$order->user_id)->pluck('tokens')->toArray();
        $result_ar = $this->send_notification($data['title_ar'],$data['body_ar'],$notification,$userToken);
        $result_en = $this->send_notification($data['title_en'],$data['body_en'],$notification,$userToken);

        return $this->ApiResponse(true,__('api.state changed successfully'),200);
    }

    public function checkPromoCode(Request $request){

        $branch = Branch::find($request->branch_id);
        if(!$branch){
            return $this->ApiResponse(false,__('api.no such this data'),404);
        }
        $promoCode = Coupon::where(['promo_code'=>$request->promo_code,'active'=>1])->first();
        if (!$promoCode){
            return $this->ApiResponse(false,__('api.invalid promo code'),404);
        }
        if($promoCode->user_id != $branch->vendor_id && $promoCode->user_id != 1){
            return $this->ApiResponse(false,__('api.invalid promo code'),404);
        }
        $numberOfUse=DB::table('coupons_users')->where('coupon_id','=',$promoCode->id)->count();
        if($promoCode->number_of_use <= $numberOfUse || Carbon::today()->format('Y-m-d') >= $promoCode->available_until){
            return $this->ApiResponse(false,__('api.invalid promo code'),401);
        }
        return $this->ApiResponse(true,__('api.valid promo code'),200);
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $cart = Cart::find($request->cart_id);
            $branch = Branch::find($cart->branch_id);

            if(!$cart || !$branch){
                return $this->ApiResponse(false,__('api.cart is empty'),404);
            }
            $cartItems = $cart->items;
            $additions = $cartItems->where('type','addition');
            $purePriceForItemsAdditionQuantity=[];
            foreach ($additions as $item){
                $addition= Addition::find($item->service_id);
                $purePriceForItemsAdditionQuantity[$item->service_id] = $addition->price*$item->quantity;
            }
            $additionsPriceSum = array_sum($purePriceForItemsAdditionQuantity);

            $services = $cartItems->where('type','service');
            $purePriceForItemsServiceQuantity=[];
            foreach ($services as $item){
                $service = $item->service->sizes->where('id',$item->size_id)->first();
                $purePriceForItemsServiceQuantity[$item->service_id] = $service->pivot->price*$item->quantity;
            }
            $servicesPriceSum = array_sum($purePriceForItemsServiceQuantity);

            $subTotal = $servicesPriceSum + $additionsPriceSum;
            $code = Coupon::where('promo_code',$request->promo_code)->first();

            $total = $subTotal + ($subTotal * $branch->vendor->tax/100) - $code->discount_amount??0;
            $lastOrder = Order::latest()->first();
            //TODO if payment method is visa

            $data = [
                'order_number'=>$lastOrder->order_number + 1,
                'user_id' => $cart->user_id,
                'branch_id' => $cart->branch_id,
                'delivery_type_id' => $request->delivery_type_id,
                'order_status_id' => 6,
                'payment_method_id' => $request->payment_method_id,
                'total_before_discount_and_tax' =>$subTotal,
                'total_after_discount_and_tax' =>$total,
                'payment_status' => 0,
                'firebase_id' =>'##',
                'tax' =>$branch->vendor->tax,
                'notes' =>$request->notes??null,
                'coupon_discounts' => $code->discount_amount??0,
                'discount' => $code ? 1 : 0,
                'discount_reason' => $code? 'by promoCode':null
            ];
            if($code){
                $code->users()->attach([$cart->user_id]);
            }
            $order = Order::create($data);
            foreach ($cartItems as $item){
                OrderItems::create([
                   'order_id'=>$order->id,
                   'service_id' => $item->service_id,
                   'size_id' => $item->size_id,
                   'type' => $item->type,
                   'quantity' => $item->quantity,
                    'price' =>$item->type == 'service'?
                        $purePriceForItemsServiceQuantity[$item->service_id]:
                        $purePriceForItemsAdditionQuantity[$item->service_id]
                ]);
            }
            $notification = Notification::create([
                'title_ar' =>'لقد تم إضافة طلب لديكم',
                'body_ar' =>'لقد قام ' . auth()->user()->name . 'بإضافة طلب جديد لديكم برقم # ' . $order->order_number,
                'title_en' =>'New Order Added',
                'body_en' =>auth()->user()->name . ' Add new order # ' . $order->order_number,
                'user_id' => $order->branch->user->id,
                'order_id' => $order->id
            ]);
            Notification::create([
                'title_ar' =>'لقد تم إضافة طلب لديكم',
                'body_ar' =>'لقد قام ' . auth()->user()->name . 'بإضافة طلب جديد لديكم برقم # ' . $order->order_number,
                'title_en' =>'New Order Added',
                'body_en' =>auth()->user()->name . ' Add new order # ' . $order->order_number,
                'user_id' => $order->branch->vendor->user->id,
                'order_id' => $order->id
            ]);
            Notification::create([
                'title_ar' =>'لقد تم إضافة طلب لديكم',
                'body_ar' =>'لقد قام ' . auth()->user()->name . 'بإضافة طلب جديد لديكم برقم # ' . $order->order_number,
                'title_en' =>'New Order Added',
                'body_en' =>auth()->user()->name . ' Add new order # ' . $order->order_number,
                'user_id' => 1,
                'order_id' => $order->id
            ]);
            $branchTokens = FcmToken::where('user_id',$order->branch->user->id)->pluck('tokens')->toArray();
            $adminTokens = FcmToken::where('user_id',1)->pluck('tokens')->toArray();
            $vendorTokens = FcmToken::where('user_id',$order->branch->vendor->user->id)->pluck('tokens')->toArray();
            $tokens = array_merge($branchTokens,$adminTokens,$vendorTokens);
            $result = $this->send_notification($notification->title_ar,$notification->body_ar,$notification,$tokens);
            DB::commit();
            return $this->ApiResponse(true,__('api.order created successfully'),200,$order->order_number);
        }catch (\Exception $exception){
            DB::rollBack();
            return $this->ApiResponse(false,__('api.something went wrong'),401,$exception->getMessage());
        }
    }

}
