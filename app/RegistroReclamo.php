<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroReclamo extends Model
{
    public function reclamo()
    {
        return $this->belongsTo('App\Reclamo');
    }
}
