<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'name',
    ];

    public function reclamos()
    {
        return $this->hasMany('App\Reclamo');
    }

    public function registroAvistamientos()
    {
        return $this->hasMany('App\RegistroAvistamiento');
    }
}
