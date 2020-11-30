<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Reat extends Model
{
       //
       protected $table = 'reats';

       protected $fillable = [
        'reat','user_id', 'prov_id'
    ];
    public function Prov(){
        return $this->belongsTo('App\models\Prov', 'prov_id');
    }

    public function user(){
        return $this->belongsTo('App\models\User', 'user_id');
    }


}
