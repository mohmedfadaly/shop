<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Serv extends Model
{
       //
       protected $table = 'servs';

       protected $fillable = [
        'name','osalary','salary', 'prov_id',
    ];

    public function Prov(){
        return $this->belongsTo('App\models\Prov', 'prov_id');
    }

    public function requests(){
        return $this->belongsToMany('App\models\Req','req_servs','ser_id','req_id');
    }
}
