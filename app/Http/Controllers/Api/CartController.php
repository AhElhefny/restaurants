<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\services\ApiResponseTrait;
use App\Models\Branch;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ApiResponseTrait;
    public function AddToCart(Request $request){

        $branch = Branch::where(['id'=>$request->branch_id,'active'=>1,'is_open'=>1])->first();
        if(!$branch){
            return $this->ApiResponse(false,__('api.no such this data'),404,['branch not found']);
        }

        $service = $branch->services()->where('service_id',$request->service_id)->first();
        if(!$service){
            return $this->ApiResponse(false,__('api.no such this data'),404,['service not found at this branch']);
        }

        $size = $service->sizes()->where('size_id',$request->size_id)->first();
        if (!$size){
            return $this->ApiResponse(false,__('api.no such this data'),404,['size not available with this service']);
        }

        $authUser = auth('api')->user();
        if (!$authUser){
            $userCart = $request->cart_id ? Cart::find($request->cart_id) : null;
            $userCart = $userCart ?? Cart::create(['branch_id' => $request->branch_id]);
        }else
            $userCart = $authUser->cart;

        if (!$userCart){
            $userCart = Cart::craete([
                'user_id' => $authUser,
                'branch_id' => $branch->id
            ]);
        }

        if($userCart->branch_id != $request->branch_id){
            if(isset($userCart->items))
                $userCart->items()->delete();

            $userCart->update(['branch_id' => $request->branch_id]);
        }

        $item = $userCart->items()->where(['service_id'=>$service->id,'size_id'=>$size->id])->first();


        if ($item){
            $res = $item->update(['quantity'=>$item->quantity+($request->quantity??1)]);
        }
        else{
            $res = $userCart->items()->create([
                'service_id' => $service->id,
                'size_id' => $size->id,
                'quantity' => $request->quantity,
            ]);
        }

        if(!$res){
            return $this->ApiResponse(false,__('api.something went wrong'),402);
        }
        return $this->ApiResponse(true,__('api.item added successfully'),200);
    }

    public function RemoveFromCart(){

    }

    public function ClearCart(Request $request){
        $cart = Cart::find($request->cart_id);
        if (!$cart){
            return $this->ApiResponse(false,__('api.no such this data'),404,['cart not found']);
        }
        $cart->items()->delete();
        return $this->ApiResponse(true,__('api.cart cleared successfully'),200,$cart->id);
    }

    public function CartItems(Request $request){
        $cart = Cart::find($request->cart_id);
        if (!$cart){
            return $this->ApiResponse(false,__('api.no such this data'),404,['cart not found']);
        }

        $items = $cart->items;

        if ($items->count()<=0){
            return $this->ApiResponse(true,__('api.cart is empty'),200,[__('api.cart is empty')]);
        }

        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,ItemResource::collection($items));
    }

    public function AddCartToUser(){

    }

    public function UserCart(){
        $cart = auth('api')->user()->cart;
        if (!$cart){
            return $this->ApiResponse(false,__('api.no such this data'),404,['cart not found']);
        }
        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,$cart);
    }
}
