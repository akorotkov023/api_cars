<?php

namespace App\Exception;

class CarsNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Cars not found');
    }
}
