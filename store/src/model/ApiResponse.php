<?php

class ApiResponse extends ApiResponseBase
{
    public function __construct($code = 500, $message = 'something bad happened', $type = 'unknown') {
        $this->code = $code;
        $this->message = $message;
        $this->type = $type;
    }
}
