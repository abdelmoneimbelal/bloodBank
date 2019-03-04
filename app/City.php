<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{
    protected $fillable = ['name', 'governrate_id'];

    public function governrate(){

        return $this->belongsTo('App\Governrate','governrate_id');

    }

    public function clients()
    {
        return $this->hasOne('App\Client');
    }


    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}
