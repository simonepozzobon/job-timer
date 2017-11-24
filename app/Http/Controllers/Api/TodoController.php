<?php

namespace App\Http\Controllers\Api;

use App\Test;
use App\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
  public function create(Request $request)
  {
      $test = new Test;
      $test->test = json_encode($request->all());
      $test->save();


      $todo = new Todo;
      $todo->project_id = $request['project_id'];
      $todo->category_id = $request['category'];
      $todo->status_id = $request['status'];
      $todo->priority_id = $request['priority'];
      $todo->description = $request['description'];
      $todo->save();

      $todo->verify_category();
      $todo->set_time();

      return response($todo, 200)->header('Content-Type', 'application/json');
  }
}
