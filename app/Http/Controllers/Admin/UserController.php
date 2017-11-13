<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index ()
    {
        $users = User::all();
        $roles = UserRole::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create (Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function edit ($id, Request $request)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function destroy ($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
