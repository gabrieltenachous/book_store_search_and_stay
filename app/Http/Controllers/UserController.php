<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;  

class UserController extends Controller
{
    public function login(LoginUserRequest $request){
        $user = User::where('email', $request->email)->first(); 
        if (!$user || !Hash::check($request->password, $user->password)) {
           return response()->json('Login invalid', 503);
        }
  
        return response()->json([ 
            'message' => 'User Logged In Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }

    public function logout(Request $request){ 
        $accessToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($accessToken);
        $token->delete();
        return response()->json([ 
            'message' => 'User Loggout!!', 
        ], 200);
    }

    public function register(RegisterUserRequest $request){
        return User::create($request->all());
    }
}
