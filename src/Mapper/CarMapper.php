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
            ->setPhoto($car->getPhoto())
            ->setPrice($car->getPrice())
            ->setBrand([$car->getBrand()->getId(), $car->getBrand()->getName()])
            ->setModel([$car->getModel()->getId(), $car->getModel()->getName()]);
    }

}
