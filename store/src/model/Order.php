<?php

class Order extends \RedBeanPHP\SimpleModel
{
    public static $rules = [
        'id' => [
            'validation' => 'required|numeric',
        ],
        'pet_id' => [
            'validation' => 'required|numeric',
        ],
        'quantity' => [
            'validation' => 'required|numeric',
        ],
        'ship_date' => [
            'validation' => 'required|date',
        ],
        'status' => [
            'validation' => 'required|alpha',
        ],
        'complete' => [
            'validation' => 'required|boolean',
        ],
    ];
}
