<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('latitude', 'longtude','blood_type', 'client_id', 'city_id', 'name', 'age', 'blood_type_id', 'number_ofbage_requierd', 'hospital_name', 'detailes', 'phone');

    public function notification()
    {
        return $this->hasMany('App\Notification');
    }
    public function city(){

        return $this->belongsTo('App\City');

    }
    public function clients()
    {
        return $this->belongsTo('App\Client');

    }

    public function bloodTypes(){
        return  $this->belongsTo('App\BloodType', 'blood_type_id');
    }
}
