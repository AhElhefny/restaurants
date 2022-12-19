<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\services\DefaultModelAttributesTrait;
use App\Models\Vendor;

class WorksTime extends Model
{
    use DefaultModelAttributesTrait;
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [''];
    protected $appends= ['notes'];
    protected $hidden=['notes_ar','notes_en'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getFromAttribute($val){
        return substr($val,0,5);
    }

    public function getToAttribute($val){
        return substr($val,0,5);
    }

    public function getNotesAttribute(){
        return app()->getLocale() == 'ar' ? $this->notes_ar : $this->notes_en ;
    }
}
