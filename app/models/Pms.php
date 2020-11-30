<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Pms extends Model
{
       //
       protected $table = 'pmasseges';
       protected $fillable = [
        'masg' ,'pro_id'
    ];

    public function pro(){
        return $this->belongsTo('App\models\Prov', 'pro_id');
    }

}
