<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';

    public function project ()
    {
        return $this->belongsTo('App\Project');
    }

    public function priority ()
    {
        return $this->belongsTo('App\Priority');
    }
}
