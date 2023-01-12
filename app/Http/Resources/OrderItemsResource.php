<?php

namespace App\Http\Resources;

use App\Models\Addition;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->type == 'service'){
            $size = $this->service->sizes()->where('size_id',$this->size_id)->first();
        }else
            $addition = Addition::where('id',$this->service_id)->first();
        return [
            'id' => $this->id,
            'service' => $this->type == 'service'?$this->service->name:$addition->name,
            'service_image' => $this->type == 'service'?$this->service->image:$addition->image,
            'size' => $size->name??null,
            'price' => $this->type == 'service'?$size->pivot->price:$addition->price ,
            'quantity' => $this->quantity,
            'type' => $this->type
        ];
    }
}
