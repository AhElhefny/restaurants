<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $size = $this->service->sizes()->where('size_id',$this->size_id)->first();
        return [
            'item_id' => $this->id,
            'service_name' => $this->service->name,
            'size_name' => $size->name,
            'price' =>$size->pivot->price ,
            'quantity' => $this->quantity
        ];
    }
}
