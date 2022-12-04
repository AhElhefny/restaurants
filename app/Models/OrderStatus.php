<?php

namespace App\Models;

use App\Http\services\DefaultModelAttributesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use HasFactory;
    use SoftDeletes;
    use DefaultModelAttributesTrait;

    protected $appends=['name'];
    protected $hidden=['name_ar','name_en'];

//    public function order(){
//        return $this->belongsTo(Order::class);
//    }
}
