<?php

namespace App\Exceptions;

use Exception;
use App\Traits\ApiTraits;
use App\Exceptions\ResourceNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiTraits;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Exception $exception, $request) {
            return $this->handleApiException($request, $exception);
        });
    }

    private function handleApiException($request, Exception $exception)
    {
        if ($exception instanceof ResourceNotFoundException) {
            return $this->apiResponse($exception->getMessage(), $exception->getStatusCode());
        }

        $exception = $this->prepareException($exception);

        if ($exception instanceof ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception);
    }


    private function customApiResponse($exception)
    {
        if (method_exists($exception, "getStatusCode"))
            $statusCode = $exception->getStatusCode();
        else
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        if (method_exists($exception, "getMessage")) {
            return $this->apiResponse($exception->getMessage(), $statusCode);
        } else {
            $data = [];
            $data["errors"] = $exception->original["errors"];
            return $this->errorResponse($data, $exception->original["message"], Response::HTTP_BAD_REQUEST);
        }
    }    
}
