<?php

namespace App\Models;

use App\Http\services\DefaultModelAttributesTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class DeliveryMan extends Model
{
    use HasFactory;
    use SoftDeletes;


    const PENDING = 0;
    const ACTIVE = 1;
    const INACTIVE = 2;
    const REJECTED = 3;

    protected $guarded=[''];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(DeliveryCompany::class,'company_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public static function getStatus($state){
        $str ='';
        switch ($state){
            case $state == self::PENDING:
                return 'PENDING';
            case $state == self::ACTIVE:
                return $str = 'Active';
            case $state == self::INACTIVE:
                return $str = 'INACTIVE';
            case $state == self::REJECTED:
                return $str = 'REJECTED';
        }
        return $str;
    }
}
