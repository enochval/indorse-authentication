<?php
/**
 * Created by PhpStorm.
 * User: enochval
 * Date: 2/26/19
 * Time: 6:20 PM
 */

namespace App\Traits;


trait Response
{
    public function success($msg = '')
    {
        return response()->json([
            'status' => true,
            'success' => $msg
        ], 200);
    }

    public function withData($data)
    {
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function error($msg = 'Something went wrong, Please try again later', $code = 400)
    {
        return response()->json([
            'status' => false,
            'error' => $msg
        ], $code);
    }
}