<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function verify(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return Helper::success('Email already verified');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return Helper::success('Email verified successfully');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return Helper::success('Verification link sent!');
    }
}
