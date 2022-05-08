<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class My_Parent extends Authenticatable
{
    use HasTranslations;
    public $translatable = ['Name_Father','Job_Father','Name_Mother','Job_Mother'];
    protected $table = 'my__parents';
    protected $guarded=[];



    public function fatherNationality()
    {
        return $this->belongsTo('App\Models\Nationalitie', 'Nationality_Father_id');
    }



    public function motherNationality()
    {
        return $this->belongsTo('App\Models\Nationalitie', 'Nationality_Mother_id');
    }

}
