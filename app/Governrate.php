<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governrate extends Model 
{

    protected $table = 'governrates';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function governrate()
    {
        return $this->hasMany('App\City');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

}