<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Code to list users
        $users = User::paginate(3);
        return view('users.manage', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete(); // Delete the user
        return redirect()->route('admin.users.index')->with('status', 'User deleted successfully');
    }

}
