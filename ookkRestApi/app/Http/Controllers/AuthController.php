<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
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
        //Kiểm tra user nếu không tồn tại, trạng thái không hoạt động, và password không đúng thì trả về lỗi
        $validator = Validator::make($request->all(), 
        [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Something went wrong',
                'data' => $validator->errors(),
            ], 403);
        }

        $token=auth()->attempt($validator->validated());

        if(!$token){
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        return $this->createJwtToken($token);
    }

    /**
     * Create token tra ve cho client
     * @param string $token
     */
    private function createJwtToken($token){
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => auth()->user()
        ]);
    }
}