<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
       //
       protected $table = 'banks';
       protected $fillable = [
        'name','num','ipan'
    ];

    public function trans() {
        return $this->hasMany('App\models\Trans');
    }
}
