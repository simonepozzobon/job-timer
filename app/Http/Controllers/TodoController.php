<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRole;
use App\TodoStatus;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
