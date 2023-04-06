<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class UserController extends Controller
{
    //

    public function store(Request $request)
    {

        $input = $request->all();

        $request->validate([
            'name'                      =>      'required',
            'email'                     =>      'required|email:dns',
            'password'                  =>      'required|confirmed|min:1',
            'password_confirmation'     =>      'required_with:password|same:password|min:1',
        ]);

        User::create([
            'name'              => $input['name'],
            'email'             => $input['email'],
            'password'          => Hash::make($input['password']),
            'confirm_password'  => Hash::make($input['confirm_password']),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Registration Success'
        ]);
    }

    public function check(Request $request)
    {

        $credentials = $request->validate([
            'email'         => 'required|exists:users,email',
            'password'      => 'required',
        ]);

        if (Auth::attempt($credentials))
        {

            return response()->json([
                'status' => true,
                'message' => 'Success'
            ]);
        }

            return response()->json([
                'status' => false,
                'message' => 'Fail'
            ]);
    }

    public function logout(){
        Auth::logout();

        return response()->json([
            'status' => true,
            'message' => 'Success Logout'
        ]);
    }
}
