<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\services\pushTrait;
use App\Models\Addition;
use App\Models\Branch;
use App\Models\FcmToken;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use function Symfony\Component\String\b;

class OrdersController extends Controller
{
    use pushTrait;
    public function __construct()
    {
        $this->middleware('permission:orders',['only'=>['index']]);
        $this->middleware('permission:edit-order',['only'=>['edit']]);
        $this->middleware('permission:show-order',['only'=>['show']]);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if(\request()->ajax()){
            if($user->type != User::ADMIN){
                $branch_ids = $user->type == User::VENDOR ?
                    Branch::where('vendor_id',$user->vendor->id)->pluck('id')->toArray() :
                    [$user->branch->id];
                $orders = Order::with(['user','branch','orderStatus','paymentMethod'])->whereIn('branch_id', $branch_ids)->get();
            }else{
                $orders = Order::with(['user','branch','orderStatus','paymentMethod'])->get();
            }
            return DataTables::of($orders)->make(true);
        }
        return view('dashboard.orders.index');
    }

    public function show(Order $order){
        Notification::where('order_id',$order->id)->update(['seen'=>1]);
        $services = $order->orderItems->where('type','service');
        $additionsIds = $order->orderItems->where('type','addition')->pluck('service_id')->toArray();
        $additions = Addition::find($additionsIds);
//        dd($services,$additions);
        return view('dashboard.orders.details',['order'=>$order,'additions'=>$additions,'services'=>$services]);
    }

    public function changeStatus(Request $request,Order $order){
        $oldStatus = OrderStatus::find($order->order_status_id);
        $newStatus = OrderStatus::find($request->order_status);
        $data['title_ar'] = 'تم تغيير حالة طلبكم ';
        $data['body_ar']= 'تم تغيير حالة الطلب من ' . $oldStatus->name . ' الي ' .$newStatus->name;
        $data['title_en'] = 'The status of your request has changed';
        $data['body_en']= 'The status of your request has changed from '. $oldStatus->name_en . ' to ' . $newStatus->name_en;
        $data['user_id']= $order->user_id;
        $data['order_id'] = $order->id;
        $notification = Notification::create($data);
        $token = FcmToken::where('user_id',$order->user_id)->pluck('tokens')->toArray();
        $res_ar = $this->send_notification($notification->title_ar,$notification->body_ar,$notification,$token);
        $res_en = $this->send_notification($notification->title_en,$notification->body_en,$notification,$token);
        $order->update(['order_status_id'=>$request->order_status]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }

    public function editPaySetting(Request $request,Order $order){
        $order->update([
            'payment_method_id' => $request->payment_method_id,
            'payment_status' => $request->payment_status
        ]);
        return back()->with(['success'=>__('dashboard.item updated successfully')]);
    }

    public function invoice(Order $order){
        return view('dashboard.orders.invoice',['order'=>$order]);
    }
}
