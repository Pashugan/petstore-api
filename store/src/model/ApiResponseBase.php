<?php

abstract class ApiResponseBase
{
    public $code;
    public $message;
    public $type;

    public function toArray() {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'type' => $this->type,
        ];
    }
}
