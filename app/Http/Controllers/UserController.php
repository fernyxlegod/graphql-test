<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('posts')->orderBy('name')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function show(User $user): View
    {
        $user->load(['posts' => function($query) {
            $query->orderBy('updated_at', 'desc');
        }]);

        return view('users.show', compact('user'));
    }
}
