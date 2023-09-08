<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * Method for get in for user
     */
    public function userInfo(){
        return response()->json(auth()->user(), 200);
    }


    /**
     * Logout method
     */
    public function logout(){
        auth()->logout();

        return response()->json([
            'message' => 'User is logged out']
        );
    }
}
