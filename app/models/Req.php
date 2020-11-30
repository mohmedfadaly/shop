<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Req extends Model
{
       //
       protected $table = 'requests';

       protected $fillable = [
        'state','user_id', 'prov_id','time_from','time_to','address','longitude','latitude','date','des','active','why','phone','name','Total','tax'
    ];
    public function Prov(){
        return $this->belongsTo('App\models\Prov', 'prov_id');
    }

    public function user(){
        return $this->belongsTo('App\models\User', 'user_id');
    }
    public function Servs(){
        return $this->belongsToMany('App\models\Serv','req_servs','req_id','ser_id');
    }


}
