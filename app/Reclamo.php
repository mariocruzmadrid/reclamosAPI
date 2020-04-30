<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    public function animal()
    {
        return $this->belongsTo('App\Animal');
    }

    public function registroReclamos()
    {
        return $this->hasMany('App\RegistroReclamo');
    }
}
