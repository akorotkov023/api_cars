<?php

namespace App\Mapper;

use App\Entity\Car;
use App\Model\BaseCarDetails;

class CarMapper
{
    public static function map(Car $car, BaseCarDetails $model): void
    {
        $model
            ->setId($car->getId())
//            ->setBrand($car->getBrand())
//            ->setModel($car->getModel())
            ->setPhoto($car->getPhoto())
            ->setPrice($car->getPrice());
    }
}
