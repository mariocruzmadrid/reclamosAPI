<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reproduccion extends Model
{
    protected $fillable = [
        'date','reclamo_id',
    ];

    public function reclamo()
    {
        return $this->belongsTo('App\Reclamo');
    }
}
