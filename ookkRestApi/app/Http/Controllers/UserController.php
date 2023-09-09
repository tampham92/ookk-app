<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\Models\User;

class UserController extends Controller
{
    /**
     * Method for get in for user
     */
    public function userInfo()
    {
        return response()->json(auth()->user(), 200);
    }


    public function update($id, Request $request)
    {
        // dd($request);
        // Validate data submit lên từ frontend
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'name' => 'required|string|max:255',
        //         'email' => 'required|string|email|max:255',
        //     ]
        // );

        // if($validator->fails()){
        //     return response()->json([
        //         'message' => 'Something went wrong',
        //         'data' => $validator->errors(),
        //     ], 422);
        // }


        // $user = User::whereId($id)->first();
        // dd($user);
        
        // if(is_null($user)){
        //     return response()->json([
        //         'message' => 'User not foud',
        //         'data' => null,
        //     ], 404);
        // }
        // $user = User::find($id);

        // // $user = request()->user();
        // if(!is_null($user)){
        //     $user->update([
        //         'name'->$request->name,
        //         'email'->$request->email
        //     ]);
        //     return response()->json([
        //         'message' => 'User is updated',
        //         'data' => $user,
        //     ]);
        // }
        
        // $update = User::save($user);

        
    }

    /**
     * Logout method
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(
            [
                'message' => 'User is logged out'
            ]
        );
    }
}