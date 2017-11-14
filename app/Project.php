<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function todos()
    {
        return $this->hasMany('App\Todo')->where('archived', '=', 0)->orderBy('order');
    }

    public function archived_todos()
    {
        return $this->hasMany('App\Todo')->where('archived', '=', 1)->orderBy('order');
    }
}
