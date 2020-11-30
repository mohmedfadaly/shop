<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
       //
       protected $table = 'sections';
       protected $fillable = [
        'name'
    ];

    public function providers() {
        return $this->hasMany('App\models\Prov');
    }
}
