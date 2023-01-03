<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authUser =auth()->user();
        $orders = Order::with(['branch'])->when($authUser->type != User::ADMIN,function ($q)use($authUser){
            $q->whereHas('branch',function ($q)use ($authUser){
               $q->where(function ($q)use ($authUser){
                   $q->when($authUser->type == User::VENDOR,function ($q)use ($authUser){
                      $q->whereIn('id',$authUser->vendor->branches()->pluck('id')->toArray());
                   })->when($authUser->type == User::BRANCH_MANAGER,function ($q)use ($authUser){
                      $q->where('id',$authUser->branch->id);
                   });
               }) ;
            });
        })->orderByDesc('id')->get();
        $orderDetail['pending'] = $orders->whereNotIn('order_status_id',[Order::FINISHED,Order::CANCELED])->count();
        $orderDetail['finished'] = $orders->where('order_status_id',Order::FINISHED)->count();
        $orderDetail['canceled'] = $orders->where('order_status_id',Order::CANCELED)->count();
        $ordersCount['lastDay'] = $this->getOrdersCountLatestSevenDays(1);
        $ordersCount['latestTwoDay'] = $this->getOrdersCountLatestSevenDays(2);
        $ordersCount['latestThreeDay'] = $this->getOrdersCountLatestSevenDays(3);
        $ordersCount['latestFourDay'] = $this->getOrdersCountLatestSevenDays(4);
        $ordersCount['latestFiveDay'] = $this->getOrdersCountLatestSevenDays(5);
        $ordersCount['latestSexDay'] = $this->getOrdersCountLatestSevenDays(6);
        $ordersCount['lastSevenDay'] = $this->getOrdersCountLatestSevenDays(7);

        $users = User::with(['orders'])->where('type',User::USER)
            ->when($authUser->type != User::ADMIN,function ($q)use ($authUser){
            $q->whereHas('orders',function ($q)use ($authUser){
               $q->when($authUser->type == User::VENDOR,function ($q)use ($authUser){
                   $q->whereIn('branch_id',$authUser->vendor->branches()->pluck('id')->toArray());
               })->when($authUser->type == User::BRANCH_MANAGER,function ($q)use ($authUser){
                   $q->where('branch_id',$authUser->branch->id);
               });
            });
        })->get();
        $usersCount['LastMonth'] = $this->getUsersCountLatestMonths(1);
        $usersCount['LatestTowMonth'] = $this->getUsersCountLatestMonths(2);
        $usersCount['LatestThreeMonth'] = $this->getUsersCountLatestMonths(3);
        $usersCount['LatestFourMonth'] = $this->getUsersCountLatestMonths(4);

        return view('dashboard.index',[
            'orders' => $orders,
            'orderDetail' => $orderDetail,
            'ordersCountLatestSevenDays' => $ordersCount,
            'users' => $users,
            'usersCountLatestFourMonth' => $usersCount,
        ]);
    }

    private function getUsersCountLatestMonths(int $num):int {
       return DB::table('users')
            ->select('*')
            ->where('type','=',User::USER)
            ->whereYear('users.created_at','=',Carbon::now()->subMonths($num)->format('Y'))
            ->whereMonth('users.created_at','=',Carbon::now()->subMonths($num)->format('m'))
            ->when(auth()->user()->type != User::ADMIN,function ($q){
                $q->when(auth()->user()->type == User::VENDOR,function ($q){
                    $q->join('orders','orders.user_id','=','users.id')
                        ->whereIn('branch_id',auth()->user()->vendor->branches()->pluck('id')->toArray());
                })->when(auth()->user()->type == User::BRANCH_MANAGER,function ($q){
                   $q->join('orders','orders.user_id','=','users.id')
                       ->where('branch_id',auth()->user()->branch->id);
                });
            })
            ->count();
    }

    private function getOrdersCountLatestSevenDays(int $num):int {
        return DB::table('orders')
            ->select('*')
            ->join('branches','branches.id','=','orders.branch_id')
            ->join('vendors','vendors.id','=','branches.vendor_id')
            ->whereDay('orders.created_at','=',Carbon::now()->subDays($num)->format('d'))
            ->when(auth()->user()->type != User::ADMIN,function ($q){
                $q->when(auth()->user()->type == User::VENDOR,function ($q){
                    $q->where('vendor_id',auth()->user()->vendor->id);
                })->when(auth()->user()->type == User::BRANCH_MANAGER,function ($q){
                    $q->where('branch_id',auth()->user()->branch->id);
                });
            })->count();

    }
}
