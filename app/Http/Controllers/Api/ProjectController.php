<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use App\Todo;
use App\Project;
use App\Priority;
use Carbon\Carbon;
use App\TodoStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function get_projects()
    {
      $projects = Project::with('todos', 'todos.category', 'archived_todos', 'archived_todos.category', 'categories', 'user')->get();

      return response($projects, 200)->header('Content-Type', 'application/json');
    }

    public function set_main(Request $request)
    {
      $previous_main = Project::where('is_main', '=', 1)->first();
      $project = Project::find($request->id);

      // resetto il principale
      $previous_main->is_main = 0;
      $previous_main->save();

      // setto il nuovo principale
      $project->is_main = 1;
      $project->save();

      return response()->json([
        'success' => true,
        'project' => $project,
      ], 200);
    }
}
