<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\services\DefaultModelAttributesTrait;
use App\Models\Branch;

class DeliveryType extends Model
{
    use HasFactory;
    use SoftDeletes;
    use DefaultModelAttributesTrait;

    protected $appends = ['type'];
    protected $hidden = ['type_ar','type_en'];
    protected $guarded = [''];

    public function getTypeAttribute(){
        return app()->getLocale() == 'ar' ? $this->type_ar : $this->type_en ;
    }
    public function branches(){
        return $this->belongsToMany(Branch::class,'branch_delivery')->wherePivot('active',1);
    }
}
