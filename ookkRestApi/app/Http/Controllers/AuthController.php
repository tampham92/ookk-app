<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use App\Models\User;
use \App\Http\Resources\User as UserResource;

class AuthController extends Controller
{
    /**
     * Method register
     * @param request $name
     */
    public function register(Request $request){
        // Validate data submit lên từ frontend
        $data = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:5'
            ]
        );

        // Return error messgage nếu có lỗi
        if ($data->fails()) {
            return response()->json([
                'message' => 'Something went wrong',
                'data' => $data->errors(),
            ], 301);
        }

        // Insert new user và trả dữ liệu về cho frontend
        $user = User::create($data->validated());

        return response()->json([
            'message' => 'User is created',
            'data' => new UserResource($user)
        ], 201);
    }

    /**
     * Method login me
     * @param request $name
     */
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        //Kiểm tra user nếu không tồn tại, trạng thái không hoạt động, và password không đúng thì trả về lỗi
        if (!empty($email) && !empty($password)){
            $user = User::where('email', $email)->first();

            if (empty($user)) {
                return response()->json([
                    'message' => 'User is not valid',
                    'data' => null
                ], 404);
            }

            if($user->active == 0){
                return response()->json([
                    'message' => 'User is disable',
                    'data' => null
                ], 403);
            }
 
            $isCheckPassword = Hash::check($password, $user->password);
            if (!$isCheckPassword){
                return response()->json([
                    'message' => 'Password is not correct',
                    'data' => null
                ], 302);
            }

            return response()->json([
                'message' => 'login suscess',
                'data' => $user
            ]);
        }
    }
}