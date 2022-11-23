<?php

namespace App\Http\services;

trait ApiResponseTrait
{
    public function ApiResponse(bool $success,string $message ,$code = 200,$data = null){
        return response()->json([
            'success'=>$success,
            'message' =>$message,
            $success==true?
            'data':'errors' =>$data
        ],$code);
    }
}
