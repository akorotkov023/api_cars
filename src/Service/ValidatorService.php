<?php

namespace App\Service;

use App\Exception\ValidException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class ValidatorService
{
    public function __construct( private ValidatorInterface $validator)
    {}

    public function valid($creditParamsRequest): void
    {
        $dataValidate = $this->validator->validate($creditParamsRequest);
        if (count($dataValidate) > 0) {
            foreach ($dataValidate as $item) {
                $errors = '[' . $item->getPropertyPath() . '] ' . $item->getMessage();
                throw new ValidException($dataValidate, $errors);
            }
        }
    }
}
