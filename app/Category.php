<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{

    protected $table = 'categoreis';
    public $timestamps = true;
    protected $fillable = array('name');

    public function category()
    {
        return $this->hasMany('App\Article');
    }

}