<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\services\pushTrait;
use App\Models\FcmToken;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AppNotificationController extends Controller
{
    use pushTrait;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $rules = [
            'title_ar' => ['required','min:4'],
            'title_en' => ['required','min:4'],
            'body_ar' => ['required','min:10'],
            'body_en' => ['required','min:10'],
            'send_to' => ['required',Rule::in([0,1])],
            'users_select' => [Rule::requiredIf($request->send_to == 1),'array'],
            $request->send_to == 0 ?:'users_select.*' => [Rule::exists('users','id')]
        ];

        $validator = Validator::make($request->except(['_token']),$rules);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $query = User::where(['block'=>0]);//TODO,'type'=>User::USER
        $user_ids = $request->send_to == 0 ? $query->pluck('id')->toArray() : $query->find($request->users_select)->pluck('id')->toArray();
        $data['title_ar'] = $request->title_ar;
        $data['title_en'] = $request->title_en;
        $data['body_ar'] = $request->body_ar;
        $data['body_en'] = $request->body_en;
        foreach ($user_ids as $id){
            $data['user_id'] =$id;
            $notification =Notification::create($data);
        }
        $usersTokens = FcmToken::whereIn('user_id',$user_ids)->pluck('tokens')->toArray();
        $res_ar = $this->send_notification($data['title_ar'],$data['body_ar'],$notification,$usersTokens);
        $res_en = $this->send_notification($data['title_en'],$data['body_en'],$notification,$usersTokens);
        return back()->with(['success'=>__('dashboard.notification send successfully')]);
    }
}
