<?php

namespace App\Models;

use App\Http\services\DefaultModelAttributesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addition extends Model
{
    use HasFactory;
    use SoftDeletes;
    use DefaultModelAttributesTrait;

    protected $guarded = [''];
    protected $appends = ['name'];
    public $folder = 'additions';

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function vendorCategory()
    {
        return $this->belongsTo(VendorCategory::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class,'additions_service');
    }
}
