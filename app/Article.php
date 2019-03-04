<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Article extends Model
{

    protected $table = 'articles';
    public $timestamps = true;
    protected $fillable = array('title', 'image', 'description', 'category_id', 'publish_date', 'client_id');
    //protected $appends = array('image_full_path', 'is_favourite');

    public function getImageFullPathAttribute()
    {
        return asset($this->image);
    }

    public function category () {
        return $this->belongsTo('App\Category');
    }

    public function favourites(){
        return $this->hasMany('App\Favourite');
    }

}
