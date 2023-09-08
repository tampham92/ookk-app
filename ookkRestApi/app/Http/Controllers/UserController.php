<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use \App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    /**
     * Method for get in for user
     */
    public function userInfo($id){
        $user = User::find($id)->first();

        if (is_null($user)) {
            return response()->json([
                'message' => 'User is not valid',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'User info',
            'data' => new UserResource($user)
        ], 200);
    }
}
