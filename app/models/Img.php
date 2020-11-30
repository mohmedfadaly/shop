<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
       //
       protected $table = 'images';

       protected $fillable = [
        'images', 'pro_id',
    ];

    public function Prov(){
        return $this->belongsTo('App\models\Prov', 'pro_id');
    }




}
