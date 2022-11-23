<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\services\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function verifyMobile(Request $request){
        $rules = [
            'phone' => ['required','digits:9']
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            $message = $validator->getMessageBag()->messages()['phone'][0]??null;
            return $this->ApiResponse(false,$message??'wrong data',401,$validator->errors());
        }
        $user = User::firstOrCreate(['phone' => $request->phone]);
        $otp =rand(1111,9999);
        $user->update(['otp' => $otp]);
        return $this->ApiResponse(true,__('api.otp sent successfully'),Response::HTTP_OK,['otp'=>$user->otp]);
    }

    public function verifyOTP(Request $request){
        $rules =[
            'otp' =>['required','digits:4',Rule::exists('users','otp')],
            'phone' =>['required','digits:9',Rule::exists('users','phone')]
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $message = $validator->getMessageBag()->messages()['otp'][0]??null;
            return $this->ApiResponse(false,$message??'wrong data',Response::HTTP_UNPROCESSABLE_ENTITY,$validator->errors());
        }
        $user = User::where(['phone'=>$request->phone,'otp'=>$request->otp])->first();
        if(!$user){
            return $this->ApiResponse(false,__('api.wrong otp'),Response::HTTP_UNAUTHORIZED,[]);
        }
        if(isset($user->name) && isset($user->email)){
            // user exist before
            $token = $user->createToken('api_token')->plainTextToken;
            $user->update(['otp'=>null]);

            $data['flag'] = 'old';
            $data['token'] = $token;
            $data['user'] = new UserResource($user);
            return $this->ApiResponse(true,__('api.you are logged in successfully'),Response::HTTP_OK,$data);
        }

        $data['flag'] = 'new';
        $data['user'] = new UserResource($user);
        return $this->ApiResponse(true,__('api.continue to complete the registration process'),Response::HTTP_OK,$data);
    }

    public function register(Request $request){
        $rules =[
            'otp' =>['required','digits:4',Rule::exists('users','otp')],
            'phone' =>['required','digits:9',Rule::exists('users','phone')],
            'name' =>['required','min:5'],
            'email' =>['required','email',Rule::unique('users','email')],
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $message = $validator->getMessageBag()->messages()['name'][0].'name'??null;
            return $this->ApiResponse(false,$message??'wrong data',Response::HTTP_UNPROCESSABLE_ENTITY,$validator->errors());
        }
        $user = User::where(['phone'=>$request->phone,'otp'=>$request->otp])->first();
        $user->update([
           'otp' => null,
           'name' => $request->name,
           'email' => $request->email
        ]);
        $data['token'] = $user->createToken('api_token')->plainTextToken;;
        $data['user'] = new UserResource($user);
        return $this->ApiResponse(true,__('api.you are logged in successfully'),Response::HTTP_OK,$data);
    }

    public function logout(){
        auth('api')->user()->tokens()->delete();
        return $this->ApiResponse(true,__('api.you are logged out successfully'),Response::HTTP_OK);
    }
}
