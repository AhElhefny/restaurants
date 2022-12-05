<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\services\ApiResponseTrait;
use App\Models\DeliveryType;
use Illuminate\Http\Request;

class DeliveryTypesControllr extends Controller
{
    use  ApiResponseTrait;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $deliveryTypes = DeliveryType::where('active',1)->get();
        return $this->ApiResponse(true,__('api.data retrieved successfully'),200,$deliveryTypes);
    }
}
