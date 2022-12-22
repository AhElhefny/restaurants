<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
          'id'             => $this->id,
          'address'        => $this->address,
          'image'          => $this->image,
          'range_of_price' => $this->range_of_delivery_price,
          'reviews'        => $this->reviews,
          'is_open'        => $this->is_open,
          'phone'          => $this->phone,
          'distance'       => round($this->distance,2),
          'name'           => $this->name,
          'owner'          => $this->vendor->name,
          'category'       => $this->vendor->category->name,
          'works_time'     => $this->vendor->worksTime,

        ];
    }
}
