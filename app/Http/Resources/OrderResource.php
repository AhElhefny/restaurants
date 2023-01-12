<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'deliveryType' => $this->deliveryType->type,
            'user' => $this->user->name,
            'branch' => $this->branch->name,
            'status' => $this->orderStatus->name,
            'payment_method' => $this->paymentMethod->method,
            'firebase_id' => $this->firebase_id,
            'sub-total' => $this->total_before_discount_and_tax,
            'total' => $this->total_after_discount_and_tax,
            'tax' => $this->tax,
            'items' => OrderItemsResource::collection($this->orderItems)
        ];
    }
}
