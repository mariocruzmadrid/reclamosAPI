<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    protected $fillable = [
        'title','description','animal_id','url',
    ];

    public function animal()
    {
        return $this->belongsTo('App\Animal');
    }

    public function registroReclamos()
    {
        return $this->hasMany('App\RegistroReclamo');
    }
}
