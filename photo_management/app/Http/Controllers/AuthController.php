<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function Show()
    {
        return View('Welcome');
    }

    public function Login()
    {
        validator(\request()->all(), [
            'email'=> ['required','email'],
            'password'=> ['required']

        ])->validate();

            if(Auth()->attempt(request()->only(['email','password'])))
            {
                return redirect()->action('/sidenbar');
            }
            else
            {
                return redirect()->back()->withErrors($validator)->withInput(['email'=>'invalid Credential']);
            }


    }

}
