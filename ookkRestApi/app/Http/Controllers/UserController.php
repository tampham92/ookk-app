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


    public function update(Request $request, $id)
    {
        // dd($id);
        // Validate data submit lên từ frontend
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,'.$id,
            ]
        );

        if($validator->fails()){
            return response()->json([
                'message' => 'Something went wrong',
                'data' => $validator->errors(),
            ], 301);
        }


        // $user = User::whereId($id)->first();
        // dd($user);
        
        // if(is_null($user)){
        //     return response()->json([
        //         'message' => 'User not foud',
        //         'data' => null,
        //     ], 404);
        // }
        
        // $update = User::save(validator()->validated());

        // return response()->json([
        //     'message' => 'User is updated',
        //     'data' => $update,
        // ]);
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