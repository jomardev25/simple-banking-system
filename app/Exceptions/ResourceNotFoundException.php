<?php

namespace App\Exceptions;

use RuntimeException;
use Illuminate\Http\Response;

class ResourceNotFoundException extends RuntimeException
{
    protected $value;
    protected $field;
    protected $resource;
    protected $statusCode = Response::HTTP_NOT_FOUND;

    public function __construct($resource, $field, $value)
    {
        $this->value = $value;
        $this->resource = $resource;
        $this->message = sprintf("%s not found with %s: %s", $resource, $field, $value);
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function getField()
    {
        return $this->field;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}