<?php

namespace App\Http\Controllers;

use Hash;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'                      =>      'required',
            'email'                     =>      'required|email:dns',
            'password'                  =>      'required|confirmed|min:1',
            'password_confirmation'     =>      'required_with:password|same:password|min:1',
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else {

            $input = $request->all();

            $user = User::create([
                'name'              => $input['name'],
                'email'             => $input['email'],
                'password'          => Hash::make($input['password']),
                'confirm_password'  => Hash::make($input['confirm_password']),
            ]);

            if($user){

                return response()->json([
                    'status' => 200,
                    'message' => "Registration Success"
                ], 200);
            }else{

                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ], 500);
            }
        }
    }

    public function check(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'email'         => 'required|exists:users,email',
            'password'      => 'required|confirmed',
        ]);

        $user = $request->only('email', 'password');

        if(Auth::attempt($user)) {

            return response()->json([
                'status' => 200,
                'message' => "Success Login"
            ], 200);
        } elseif($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{

            return response()->json([
                'status' => 500,
                'errors' => "Something Went Wrong"
            ], 500);
        }

    }

    public function logout(){
        Auth::logout();

        return response()->json([
            'status' => true,
            'message' => 'Success Logout'
        ]);
    }
}
