<?php

namespace App\Models;

use App\Http\services\DefaultModelAttributesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory;
    use SoftDeletes;
    use DefaultModelAttributesTrait;

    protected $guarded = [''];
    protected $appends=['method'];
    protected $hidden=[
      'method_ar',
      'method_en'
    ];

    public function getMethodAttribute(){
       return app()->getLocale() == 'ar' ? $this->method_ar:$this->method_en;
    }

//    public function orders(){
//        return $this->hasMany(Order::class,'payment_method_id');
//    }
}
