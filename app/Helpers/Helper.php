<?php

namespace App\Helpers;

class Helper
{

    public static function successWithToken($message, $key, $value, $token, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'token'   => $token->plainTextToken,
            $key      => $value
        ], $code);
    }

    public static function successWithData($message, $key, $value, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            $key      => $value
        ], $code);
    }

    public static function success($message, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ], $code);
    }

    public static function error($message, $code = 404)
    {
        return response()->json([
            'error' => true,
            'message' => $message,
        ], $code);
    }
}
