<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        User::create([
            'email' => $request ->email,
            'password' => $request ->password,
        ]);
    }

             
       


}
