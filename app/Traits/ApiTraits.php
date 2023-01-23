<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiTraits
{
    public function apiResponse(string $message = "success", int $statusCode = Response::HTTP_OK, array $data = null)
	{
        if(isset($data))
            return response()->json([
                "message" => $message, 
                "data" => $data
            ], $statusCode);

        return response()->json([
            "message" => $message
        ], $statusCode);
		
	}

    public function errorResponse(array $response = [], string $message = "error", int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR )
	{
        if(!is_null($message))
            $response["message"] = $message;

		return response()->json($response, $statusCode);
	}
}