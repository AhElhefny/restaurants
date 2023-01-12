<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $guarded=[''];

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }

    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
