<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\User;

class MessagesController extends Controllers\Controller
{
    public function index()
    {
        // Eager load address and bio relationships
//        $users = User::with('address', 'bio')->get();
        $users = User::all();
        return view('pages.messages.index', compact('users'));
    }
}
