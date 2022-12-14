<?php

namespace App\Models;

use App\Http\services\DefaultModelAttributesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DeliveryMan;

class DeliveryCompany extends Model
{
    use HasFactory;
    use SoftDeletes;
    use DefaultModelAttributesTrait;
    protected $appends=['name'];
    protected $hidden=['name_ar','name_en'];

    protected $guarded=[''];

    public function deliveryMen(){
        return $this->hasMany(DeliveryMan::class);
    }
}
