<?php

namespace App\Http\Controllers;

use App\User;
use App\Todo;
use App\Project;
use App\UserRole;
use Carbon\Carbon;
use App\TodoStatus;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function create (Request $request)
    {
        $todo = new Todo;
        $todo->project_id = $request->project_id;
        $todo->status_id = $request->status;
        $todo->priority_id = $request->priority;
        $todo->description = $request->description;
        $todo->save();

        $dt = new Carbon($todo->created_at);
        $todo->time = $dt->diffForHumans();

        return response()->json([
          $todo
        ], 200);
    }

    public function update (Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->description = $request->description;
        $todo->priority_id = $request->priority;
        $todo->status_id = $request->status;
        $todo->save();

        return response()->json([
          $todo
        ], 200);
    }

    public function destroy(Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->delete();

        return response()->json([
          'success' => true,
          'id' => $request->id
        ], 200);
    }

    public function archive(Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->archived = 1;
        $todo->save();

        return response()->json([
          'success' => true,
          'id' => $request->id,
        ], 200);
    }

    public function unarchive(Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->archived = 0;
        $todo->save();

        return response()->json([
          'success' => true,
          'id' => $request->id,
        ], 200);
    }

    public function order(Request $request)
    {
        $todos = Todo::where('project_id', '=', $request->project_id)->get();
        $sortedTodos = json_decode($request->todos);

        foreach ($sortedTodos as $key => $sTodo) {
          $todo = Todo::find($sTodo->id);
          $todo->order = $key;
          $todo->save();
        }

        return response()->json([
          'success' => true
        ], 200);

    }
}
