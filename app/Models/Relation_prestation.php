<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relation_prestation extends Model
{
    public function relation_prestations()
    {
        return $this->belongsTo('App\Models\Relation');
    }
}
