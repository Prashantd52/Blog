<?php
namespace App\Traits;
trait SearchTrait
{
    public function scopeSearch($query, $field, $search)
    {
        if ($search !== '')
        {
            return $query->where($field, 'like', "%$search%");
        }
    }
}