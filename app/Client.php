<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('city_id','name','phone','last_date_donate','blood_type_id','password','email','date_of_birth','pin_code');

   /* public function setPasswordAttribute ($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }*/

    public function city()
    {
        return $this->belongsTo('App\City');
    }

//    public function governrates()
//    {
//        return $this->belongsToMany('App\Governrate');
//    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function cantacts()
    {
        return $this->hasMany('App\Cantact');
    }

    public function favourites(){
        return $this->belongsToMany('App\Article','favourites');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

    public function governrate()
    {
        return $this->belongsToMany('App\Governrate');
    }

    public function bloodTypes(){
        return $this->belongsToMany('App\BloodType');
    }

    public function bloodType(){
        return $this->belongsTo('App\BloodType');
    }

    protected $hidden = [
        'password', 'api_token'
    ];
}
