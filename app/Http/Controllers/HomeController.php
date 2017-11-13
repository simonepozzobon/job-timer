<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Todo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role_id != 1) {

          // User Panel
          $todos = Todo::where('user_id', '=', $user->id)->get();
          return view('user_panel', compact('todos'));

        } else {

          // Admin Panel
          $users = User::where('role_id', '!=', 1)->get();
          return view('admin_panel', compact('users'));

        }
    }
}
