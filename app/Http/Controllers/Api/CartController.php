<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\services\ApiResponseTrait;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\CartItem;
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

    public function RemoveFromCart(Request $request){
        $cart = Cart::find($request->cart_id);
        if(!$cart){
            return $this->ApiResponse(false,__('api.no such this data'),404,['cart not found']);
        }

        $item = $cart->items()->where('id',$request->item_id)->first();
        if(!$item){
            return $this->ApiResponse(false,__('api.no such this data'),404,['item not found']);
        }
        $item->delete();
        return $this->ApiResponse(true,__('api.item deleted successfully'),200,['cart' => $cart]);
    }

    public function ClearCart(Request $request){
        $cart = Cart::find($request->cart_id);
        if (!$cart){
            return $this->ApiResponse(false,__('api.no such this data'),404,['cart not found']);
        }
        $cart->items()->delete();
        return $this->ApiResponse(true,__('api.cart cleared successfully'),200,['cart' => $cart->id]);
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

    public function AddCartToUser(Cart $cart){

        $oldCart = Cart::where(['user_id' => auth('api')->user()->id])->first();

        //new and old not exist
        if(!$cart && !$oldCart){
            return $this->ApiResponse(true,__('api.cart is empty'),200);
        }

        // new exist and old not exist
        if(!isset($oldCart) && $cart){
            $cart->update(['user_id'=>auth('api')->user()->id]);
            return $this->ApiResponse(true,__('api.data retrieved successfully'),200,$cart);
        }

        // new not exist and old exist
        if(!isset($cart) && $oldCart){
            return $this->ApiResponse(true,__('api.data retrieved successfully'),200,$oldCart);
        }

        // new and old exist
        if($cart && $oldCart){
            if($cart->branch_id != $oldCart->branch_id){
                $oldCart->items()->delete();
                $oldCart->delete();
                $cart->update(['user_id'=>auth('api')->user()->id]);
                return $this->ApiResponse(true,__('api.data retrieved successfully'),200,$cart);
            }
            else{
                $cartItems = CartItem::whereIn('cart_id',[$cart->id,$oldCart->id])->get();
                foreach ($cartItems as $item){
                    if(!in_array($item->service_id,$oldCart->items->pluck('service_id')->toArray()))
                        $item->update(['cart_id'=>$oldCart->id]);
                }
                $cart->items()->delete();
                $cart->delete();
            }
        }
        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,$oldCart);
    }

    public function UpdateItem(Request $request){
        $item = CartItem::find($request->item_id);
        if (!$item){
            return $this->ApiResponse(false,__('api.no such this data'),404,['item not found']);
        }
        $item->update(['quantity'=>$request->quantity??$item->quantity]);
        return $this->ApiResponse(true,__('api.data retrieved successfully'),200);
    }

    public function UserCart(){
        $cart = auth('api')->user()->cart;
        if (!$cart){
            return $this->ApiResponse(false,__('api.no such this data'),404,['cart not found']);
        }
        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,['cart' => $cart]);
    }
}
