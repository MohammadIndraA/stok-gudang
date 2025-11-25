<?php 

namespace App\Helpers;

class ResponseJson {
    public static function success($data, $message = 'Success') {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public static function error($message = 'Error', $code = 400) {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => null,
        ], $code);
    }
}
