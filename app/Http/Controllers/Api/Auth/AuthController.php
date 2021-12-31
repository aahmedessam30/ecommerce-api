<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken(config("app.name"));
        event(new Registered($user));

        return Helper::successWithToken('You are registered successfully', 'user', $user, $token, 201);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return Helper::error('email or password is wrong');
        }

        $user = Auth::user();
        $token = $user->createToken(config("app.name"));

        return Helper::successWithToken('Your are logged in successfully', 'user', $user, $token);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return Helper::success('Successfully logged out');
    }
}
