<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function makeAdmin($userId)
{
    $user = User::where('id', $userId)->first();

    if ($user) {
        $user->role = 'admin';
        $user->save();

        return 'User has been an admin';
    } else {
        return 'Cannot find user';
    }
}
public function index()
    {
        $users = User::all();

        // 在这里添加您的代码...

        return view('uploads.uploadindex', ['users' => $users]);
    }



}
