<?php namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Authenticated Users via token
     */
    public function index()
    {
        return response()->json(['authenticated-user' => auth()->user()]);
    }

    /**
     * Register users for our booking application
     */
    public function register(RegisterRequest $request)
    {
        $attributes = $request->validated();
        $user = User::create($attributes);
        $access_token = $user->createToken('Personal Access Token')->accessToken;
//        if($user != null)
//        {
//
//        }
        return response()->json(['token' => $access_token]);
    }

    /**
     * Login our users, with token
     */
    public function login(LoginRequest $request)
    {
        $attributes = $request->validated();
        if(auth()->attempt($attributes))
        {
            $user_token = auth()->user()->createToken('Personal Access Token')->accessToken;
            return response()->json(['token' => $user_token]);
        }
        else
        {
            return response()->json(['error' => 'Access Denied! ']);
        }
    }

    public function logout(LoginRequest $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'You are logged out']);
    }
}
