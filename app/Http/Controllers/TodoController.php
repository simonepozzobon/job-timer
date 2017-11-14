<?php

namespace App\Http\Controllers;

use App\User;
use App\Todo;
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
}
