<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Ums extends Model
{
       //
       protected $table = 'umasseges';
       protected $fillable = [
        'masg' ,'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\models\User', 'user_id');
    }

}
