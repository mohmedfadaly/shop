<?php

namespace App\models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpParser\Node\Expr\AssignOp\Mod;
use App\Notifications\provResetPasswordNotification;
class Prov extends Authenticatable  implements MustVerifyEmail
{
    use Notifiable;

    protected $guard = 'prov';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
       protected $table = 'providers';
       protected $fillable = [
        'name','phone', 'email', 'password', 'city_id','image_i','sec_id','address','spec_id','latitude','reats','wallet', 
        'longitude','fcm_token','api_token'

    ];

    public function Section(){
        return $this->belongsToMany('App\models\Section','sec_id');
    }

    public function City(){
        return $this->belongsToMany('App\models\City','City_id');
    }

    public function images() {
        return $this->hasMany('App\models\Img');
    }

    public function servs() {
        return $this->hasMany('App\models\Serv');
    }

    public function trans() {
        return $this->hasMany('App\models\Trans');
    }

    public function pms() {
        return $this->hasMany('App\models\Pms');
    }

    public function Reqs() {
        return $this->hasMany('App\models\Req');
    }
    public function Reats() {
        return $this->hasMany('App\models\Reat');
    }

    public function favrs() {
        return $this->hasMany('App\models\Fav');
    }
    public function nots() {
        return $this->hasMany('App\models\Not');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new provResetPasswordNotification($token));
    }

}
