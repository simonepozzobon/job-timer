<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Todo;
use Carbon\Carbon;
use App\TodoStatus;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ($id)
    {
        $user = User::find($id);
        $statuses = TodoStatus::all();
        $tds = Todo::where('user_id', '=', $id)->get();

        $todos = $tds->transform(function($td, $key) {
          $dt = new Carbon($td->created_at);
          $td->time = $dt->diffForHumans();
          return $td;
        });

        if (Auth::user()->role_id != 1) {
          return view('users.single', compact('user', 'todos', 'statuses'));
        } else {
          return view('admin.single', compact('user', 'todos', 'statuses'));
        }

    }
}
