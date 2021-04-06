<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits;

class Tag extends Model
{
    use Traits\SearchTrait;
    use SoftDeletes;
    public function blogs()
    {
        return $this->belongsToMany('App\Blog');
    }
}
