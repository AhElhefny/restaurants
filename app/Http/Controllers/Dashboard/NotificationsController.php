<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\services\pushTrait;
use App\Models\FcmToken;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    use pushTrait;
    public function readAll(){
        Notification::where('user_id',auth()->user()->id)->update(['seen'=>1]);
        return back();
    }

    public function read(Notification $notification){
        $notification->update(['seen'=>1]);
        return back();
    }

    public function updateToken(Request $request){
        try{
            FcmToken::updateOrCreate(['tokens'=>$request->token],['user_id'=>auth()->user()->id,'tokens'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }
}
