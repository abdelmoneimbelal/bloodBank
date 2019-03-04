<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('content', 'order_id', 'title');

    public function notification()
    {
        return $this->belongsToMany('App\Cn');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

}