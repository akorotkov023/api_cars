<?php

namespace App\Exception;

class CarNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Car not found');
    }
}
