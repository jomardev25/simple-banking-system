<?php

namespace App\Exceptions;

use RuntimeException;
use Illuminate\Http\Response;

class InsufficientBalanceException extends RuntimeException
{
 
    protected $accountNumber;
    protected $statusCode;

    public function __construct($accountNumber, $statusCode = Response::HTTP_BAD_REQUEST)
    {
        $this->accountNumber = $accountNumber;
        $this->statusCode = $statusCode;
        $this->message = sprintf("Insufficient balance with account number: %s", $accountNumber);
    }

    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}