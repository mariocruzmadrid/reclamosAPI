<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroAvistamiento extends Model
{
    public function animal()
    {
        return $this->belongsTo('App\Animal');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
