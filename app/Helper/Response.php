<?php
namespace App\Helper;

class Response {
    public static function Out($status, $message, $data, $status_code)
    {
        return response()->json([
            'status' => $status,
            'msg' => $message,
            'data' => $data
        ], $status_code);
    }
}