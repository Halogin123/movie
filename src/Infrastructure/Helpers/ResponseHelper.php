<?php

namespace Ducnm\Infrastructure\Helpers;

class ResponseHelper
{
    public static function sendResponse($http_code, $message, $data = null)
    {
        return response()->json([
            "status" => $http_code,
            "message" => $message,
            "data" => $data,
        ]);
    }
}
