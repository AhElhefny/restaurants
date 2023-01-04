<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[''];
    public $folder = 'offers';

    public function getImageAttribute($value){
        return $value?asset('dashboardAssets/images/'.$this->folder.'/'.$value):asset('dashboardAssets/images/defaultOffers.jpg');
    }


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
