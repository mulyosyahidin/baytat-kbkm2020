<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Relation extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function prestations()
    {
        return $this->hasMany('App\Models\Relation_prestation');
    }
}
