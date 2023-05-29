<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * send Response method
     *
     * @param  mixed $result
     * @param  mixed $message
     * @return void
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * send error response
     *
     * @param  mixed $error
     * @param  mixed $errorMessages
     * @param  mixed $code
     * @return void
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * unauthorized Response method
     *
     * @param  mixed $error
     * @param  mixed $code
     * @return void
     */
    public function unauthorizedResponse($error = 'Forbidden', $code = 403)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        return response()->json($response, $code);
    }
}
