<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governrate extends Model 
{

    protected $table = 'governrates';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function cities()
    {
        return $this->belongsToMany('App\City');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

}