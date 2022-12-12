<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsConditions extends Model
{
    use HasFactory;

    protected $guarded=[''];
    protected $hidden=['terms_ar','terms_en'];
    protected $appends=['terms'];

    public function getTermsAttribute(){
        return app()->getLocale()=='ar'?$this->terms_ar:$this->terms_en;
    }
}
