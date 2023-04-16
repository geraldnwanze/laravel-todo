<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function success($message, $data = [], $status = 200)
    {
        $data = ['message' => $message, 'data' => $data];
        return response()->json($data, $status);
    }

    public function error($message, $status = 500)
    {
        $message = is_array($message) ? $message : [$message];
        return response()->json(['message' => $message], $status);
    }
}
