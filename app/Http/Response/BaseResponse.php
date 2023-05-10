<?php

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

class BaseResponse
{
    public static function success($data = null, $message = null, $code = 200)
    {
        $response = [
            'success' => true,
        ];

        if ($data) {
            $response['data'] = $data;

            if(is_array($data)){
                $isAssoc = count(array_filter(array_keys($data), 'is_string')) > 0;
                if(!$isAssoc) $response['total'] = count($data);
            }else{
                $response['total'] = $data->count();
            }
        }

        if ($message) {
            $response['message'] = $message;
        }else{
            $response['message'] = $response['total'] . " data found";
        }

        return new JsonResponse($response, $code);
    }

    public static function error($message, $code = 400)
    {
        return new JsonResponse([
            'success' => false,
            'message' => $message,
        ], $code);
    }

    public static function unauthorized($message = 'Unauthorized')
    {
        return self::error($message, 401);
    }

    public static function notFound($message = 'Not Found')
    {
        return self::error($message, 404);
    }

    public static function internalServerError($message = 'Internal Server Error')
    {
        return self::error($message, 500);
    }
}
