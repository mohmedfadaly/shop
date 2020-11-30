<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Not extends Model
{
       //
       protected $table = 'notices';

       protected $fillable = [
        'users_id', 'pro_id','nots','kind'
    ];
    public function Prov(){
        return $this->belongsTo('App\models\Prov', 'pro_id');
    }

    public function user(){
        return $this->belongsTo('App\models\User', 'users_id');
    }


}
