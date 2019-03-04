<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model 
{

    protected $table = 'favourites';
    public $timestamps = true;
    protected $fillable = array('client_id', 'article_id');

}