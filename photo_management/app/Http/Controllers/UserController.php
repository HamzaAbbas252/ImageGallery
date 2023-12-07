<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt; 
class UserController extends Controller
{
    public function handle_user_logins(Request $request)
    {
             // Validate the request data
             $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
            ]);
        
            // Retrieve the 'email' and 'password' values from the request
            $email = $request->input('email');
            $password =($request->input('password'));

            $user = User::where('email',$email)->first();

            if ($user && Hash::check($password, $user->password)) {
            return response()->json([
                'message' => 'User Login successfull',
                'loginstatus'=> 1
            ]);
            } 
            
            else {
                return response()->json(
                    ['message' => 'User doesnot exist',
                    'loginstatus'=> 0]);
            }


}

}