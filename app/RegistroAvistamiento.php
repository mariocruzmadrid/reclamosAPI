<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroAvistamiento extends Model
{
    protected $fillable = [
        'date','user_id','animal_id',
    ];

    public function animal()
    {
        return $this->belongsTo('App\Animal');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
