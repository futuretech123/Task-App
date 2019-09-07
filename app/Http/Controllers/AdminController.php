<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
    	$users = User::where("is_admin", 0)->paginate(5);
    	return view('admin.users', compact('users'));
    }

    public function destroy(User $user){
    	$user->tasks()->delete();
    	$user->delete();
    	return redirect('/admin');
    }
}
