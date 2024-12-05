<?php

namespace App\Exception;

class CreditProgramNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Credit program not found');
    }
}
