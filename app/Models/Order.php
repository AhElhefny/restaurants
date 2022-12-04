<?php

namespace App\Models;

use App\Http\services\DefaultModelAttributesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Branch;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    use DefaultModelAttributesTrait;

    protected $guarded = [''];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function orderStatus(){
        return $this->belongsTo(OrderStatus::class);
    }

    public function deliveryType(){
        return $this->belongsTo(DeliveryType::class,'delivery_type_id');
    }

    public function orderItems(){
        return $this->hasMany(OrderItems::class,'order_id');
    }

    public function services(){
        return $this->belongsToMany(Service::class,'order_items')->withPivot(['price','quantity']);
    }

    public function sizes(){
        return $this->belongsToMany(Size::class,'order_items');
    }

}
