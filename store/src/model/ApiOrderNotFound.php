<?php

class ApiOrderNotFound extends ApiResponseBase
{
    public $code = 404;
    public $message = 'Order not found';
    public $type = 'unknown';
}
