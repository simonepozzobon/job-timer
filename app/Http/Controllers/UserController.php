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

        $projects = Project::where('user_id', '=', $id)->with('todos', 'archived_todos')->get();

        foreach ($projects as $key => $project) {
            $project->todos = $project->todos->transform(function($td, $key) {

                // Tempo trascorso dalla creazione del todo
                $dt = new Carbon($td->created_at);
                $td->time = $dt->diffForHumans();

                // Verifica se ha un timer attivo
                $timer = [
                  'status' => $td->has_active_timer(),
                  'time' => $td->calculate_timer()
                ];
                $td->timer = $timer;

                return $td;
            });

            $project->archived_todos = $project->archived_todos->transform(function($td, $key) {

                // Tempo trascorso dalla creazione del todo
                $dt = new Carbon($td->created_at);
                $td->time = $dt->diffForHumans();

                // Verifica se ha un timer attivo
                $timer = [
                  'status' => $td->has_active_timer(),
                  'time' => $td->calculate_timer()
                ];
                $td->timer = $timer;

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
