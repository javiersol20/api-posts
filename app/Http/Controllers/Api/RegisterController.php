<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:150',
           'email' => 'required|string|email|max:150|unique:users',
           'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create($request->all());

        return response($user, 200);
    }
}
