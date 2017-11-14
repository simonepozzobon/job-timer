<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Todo;
use App\Project;
use App\Priority;
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
        $priorities = Priority::all();

        $projects = Project::where('user_id', '=', $id)->with('todos', 'todos.category', 'archived_todos', 'archived_todos.category','categories')->get();

        foreach ($projects as $key => $project) {
            $project->todos = $project->todos->transform(function($td, $key) {
                $td->verify_category();
                $td->set_time();
                return $td;
            });

            $project->archived_todos = $project->archived_todos->transform(function($td, $key) {
                $td->verify_category();
                $td->set_time();
                return $td;
            });
        }

        $main_project = $projects->filter(function($project, $key) {
            return $project->is_main == 1;
        })->first();

        if (Auth::user()->role_id != 1) {
          return view('users.single', compact('user', 'projects', 'main_project', 'statuses', 'priorities'));
        } else {
          return view('admin.single', compact('user', 'projects', 'main_project', 'statuses', 'priorities'));
        }

    }
}
