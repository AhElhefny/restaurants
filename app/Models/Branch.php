<?php

namespace App\Models;

use App\Http\services\DefaultModelAttributesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Vendor;
use App\Models\DeliveryType;
use App\Models\Order;


class Branch extends Model
{
    use HasFactory;
    use SoftDeletes, DefaultModelAttributesTrait;

    public $folder = 'branches';
    protected $guarded = [''];
    protected $appends=['name'];
    protected $hidden=['name_ar','name_en'];

    public function getNameAttribute(){
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class,'branch_services')->where('active','=',1)->with(['vendor','vendorCategory'])->withPivot(['available']);
    }

    public function deliveryTypes()
    {
        return $this->belongsToMany(DeliveryType::class, 'branch_deliveries')->wherePivot('active', 1);
    }

}
