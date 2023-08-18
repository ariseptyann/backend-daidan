<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

class ApiModel extends Model
{
    public static function resultSuccess($rst, $code = '', $message = ''){

    if($code == ''){
        $code = 200;
    }

    if($message == ''){
        $message = 'OK';
    }

    $response = [
        'code' => $code, 
        'message' => $message,
        'status' => true,
        'data' => $rst
    ];

    return response()->json($response, Response::HTTP_OK);
}

public static function resultError($code, $message = ''){
    if($message == ''){
        $message = 'ERROR';
    }

    $response = [
        'code' => $code, 
        'message' => $message,
        'status' => false,
    ];

    return response()->json($response, Response::HTTP_OK);
}
}
