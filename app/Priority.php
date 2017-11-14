<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priorities';

    public function todos ()
    {
        return $this->hasMany('App\Todo');
    }
}
