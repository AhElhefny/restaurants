<?php

namespace App\Models;

use App\Http\services\DefaultModelAttributesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory;
    use SoftDeletes;
    use DefaultModelAttributesTrait;
    protected $guarded=[''];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
