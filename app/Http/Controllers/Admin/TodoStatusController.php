<?php

namespace App\Http\Controllers\Admin;

use App\TodoStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ()
    {
        $statuses = TodoStatus::all();
        return view('admin.statuses.index', compact('statuses'));
    }

    public function create (Request $request)
    {
        $status = new TodoStatus;
        $status->name = $request->title;
        $status->save();

        return redirect()->route('admin.todo-status.index');
    }

    public function edit ($id, Request $request)
    {
        $status = TodoStatus::find($id);
        $status->name = $request->title;
        $status->save();

        return redirect()->route('admin.todo-status.index');
    }

    public function destroy ($id)
    {
        $status = TodoStatus::find($id);
        $status->delete();

        return redirect()->route('admin.todo-status.index');
    }
}
