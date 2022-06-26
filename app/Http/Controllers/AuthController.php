<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:sanctum', ['except' => ['login','register']]);
    }
    public function register(UserRegisterRequest $request)
    {
        $requestData = $request->all();

        $user = User::create([
            'name' => $requestData['firstname']." ".$requestData['lastname'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expire_time' => date("Y-m-d H:i:s", strtotime("+60 minutes"))
        ]);
    }

    public function logout(Request $request) {
        $headerAuthorizationArray = 
            isset($request->header()["authorization"])? $request->header()["authorization"] : [];
        $headerAuthorization = 
            isset($headerAuthorizationArray[0])? $headerAuthorizationArray[0] : "";

        $explodeWithOutBearer = explode("Bearer ", $headerAuthorization);
        $tokenId = "";

        if (isset($explodeWithOutBearer[1])) {
            $explodeToken = explode("|", $explodeWithOutBearer[1]);
            if (isset($explodeToken[0])) {
                $tokenId = $explodeToken[0];
            }
        }
        if ($tokenId == "") {
            return response()->json(['message'  => 'Error when logout']);
        }
        
        $request->user()->tokens()->where('id', $tokenId)->delete();

        return response()->json(['message'  => 'Successful logout']);
    }
}