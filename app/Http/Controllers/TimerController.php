<?php

namespace App\Http\Controllers;

use App\Todo;
use App\User;
use App\Timer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimerController extends Controller
{
    public function play(Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->status_id = 3;
        $todo->save();

        $timer = new Timer();
        $timer->todo_id = $request->id;
        $timer->save();

        return response()->json([$timer], 200);
    }

    public function pause(Request $request)
    {
        $timer = Timer::find($request->id);
        $timer->active = 0;

        $start_time = new Carbon($timer->created_at);
        $finish_time = Carbon::now();
        $difference_in_seconds = $finish_time->diffInSeconds($start_time);

        $timer->time = gmdate('H:i:s', $difference_in_seconds);
        $timer->save();

        return response()->json([$request->all()], 200);
    }
}
