<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function client()
    {
        return $this->hasOne('App\Client');
    }

    public function orders(){
        $this->hasMany('App\Order');
    }


}
