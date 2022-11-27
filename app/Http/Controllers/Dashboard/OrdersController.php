<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $orders = $user->type == User::ADMIN ? Order::all():Order::whereIn('branch_id',function ()use($user){
            $ids = $user->type == User::VENDOR ? Branch::where('vendor_id',$user->vendor->id)->pluck('id')->toArray():[$user->branch->id];
            return $ids;
        });
    }
}
