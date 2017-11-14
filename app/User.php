<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_role ()
    {
        return $this->belongsTo('App\UserRole', 'role_id', 'id');
    }

    public function projects ()
    {
        return $this->hasMany('App\Project');
    }

    public function todo_counts()
    {
        $projects = $this->projects()->get();
        $count = 0;

        foreach ($projects as $key => $project) {
          $count = $count + $project->todos()->count();
        }
        
        return $count;
    }
}
