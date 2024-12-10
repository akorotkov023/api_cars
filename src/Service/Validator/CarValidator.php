<?php

namespace App\Service\Validator;

use App\Exception\ValidException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class CarValidator implements ValidatorService
{
    public function __construct( private ValidatorInterface $validator)
    {}

    public function validate($creditParamsRequest): void
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
