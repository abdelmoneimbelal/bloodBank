<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cantact extends Model 
{

    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = array('content', 'title', 'client_id');

}