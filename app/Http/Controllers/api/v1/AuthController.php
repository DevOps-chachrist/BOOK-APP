<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        try {
            $user = User::create([
                "name" => $name,
                "email" => $email,
                "password" => Hash::make($password)
            ]);

            return response()->json([
                "status" => "ok",
                "message" => "Create New User Successfull",
                "user" => $user
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Create New User Fail",
                "user" => $e
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        try {

            $user = User::where('email', $email)->first();

            if (!$user || !Hash::check($password, $user->password)) {
                return response()->json([
                    "status" => "error",
                    "message" => "Invalid Email or  Password !",

                ], 400);
            }

            $user->tokens->each(function ($token) {
                $token->delete();
            });



            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([
                "status" => "ok",
                "message" => "Login Successfull",
                "email" => $user->email,
                "token" => $token
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                "status" => "error",
                "message" => "Login Fail",
                "user" => $e
            ], 500);
        }
    }

    public function logout(Request $request){
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json([
            "status" => "ok",
            "message" => "Logout Successfull"

        ], 200);

    }
}
