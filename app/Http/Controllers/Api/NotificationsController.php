<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\services\ApiResponseTrait;
use App\Models\FcmToken;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationsController extends Controller
{
    use ApiResponseTrait;
    public function storeFCMToken(Request $request){
        $rules = [
            'token' => ['required','string','min:5']
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->ApiResponse(false,__('api.token is invalid'),401,$validator->errors());
        }
        $token = FcmToken::updateOrCreate(['tokens'=>$request->token],['user_id'=>auth()->user()->id,'tokens'=>$request->token]);
        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,$token);
    }

    public function index(){
        $notifications = Notification::where('user_id',auth()->user()->id)->get();
        if (!$notifications){
            return $this->ApiResponse(false,__('api.no such this data'),404);
        }
        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,$notifications);
    }
}
