<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{

    use HasTranslations;
    public $translatable = ['Name'];

    protected $fillable=['Name','Notes'];
    protected $table = 'Grades';
    public $timestamps = true;



    public function Sections() {
        return $this -> hasMany('App\Models\Section','Grade_id') -> orderBy('Name_Section');
    }

    public function Classes() {
        return $this -> hasMany('App\Models\Classroom','Grade_id');
    }

}
