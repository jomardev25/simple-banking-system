<?php

namespace App\Exceptions;

use RuntimeException;
use Illuminate\Http\Response;

class InvalidAmountException extends RuntimeException
{
    protected $statusCode = Response::HTTP_BAD_REQUEST;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}