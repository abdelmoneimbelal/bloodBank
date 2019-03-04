<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cn extends Model 
{

    protected $table = 'clients_notifications';
    public $timestamps = true;
    protected $fillable = array('client_id', 'notification_id');

}