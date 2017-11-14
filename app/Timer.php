<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    public function todo ()
    {
        return $this->belongsTo('App\Todo');
    }
}
