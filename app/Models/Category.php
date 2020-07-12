<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function category_of_article()
    {
        return $this->belongsToMany('App\Models\Article')->withPivot('category_id');
    }
}
