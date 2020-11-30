<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Trans extends Model
{
       //
       protected $table = 'trans';
       protected $fillable = [
        'name','num','bank','image','bank_id','prov_id','cash','state'
    ];

    public function Prov(){
        return $this->belongsTo('App\models\Prov', 'prov_id');
    }

    public function Bank(){
        return $this->belongsTo('App\models\Bank', 'bank_id');
    }
}
