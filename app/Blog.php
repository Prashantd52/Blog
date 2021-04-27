<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits;

class Blog extends Model
{
    use Traits\SearchTrait;
    use SoftDeletes;
    public function category()
    {
        return $this->belongsto('App\Category');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
