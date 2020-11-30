<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
       //
       protected $table = 'cities';
       protected $fillable = [
        'name'
    ];

    public function providers() {
        return $this->hasMany('App\models\Prov');
    }

}
