<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function category()
    {
        return $this->belongsto('App\Category');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
