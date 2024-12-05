<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidException extends \RuntimeException
{
    public function __construct(private readonly ConstraintViolationListInterface $violations, string $error = 'validation error')
    {
        parent::__construct($error);
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
