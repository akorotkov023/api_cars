<?php

namespace App\Tests;

use App\Entity\Brand;
use App\Entity\Car;
use App\Entity\Model;
use Doctrine\Common\Collections\ArrayCollection;

class MockUtils
{
    public static function createCar(): Car
    {
        return (new Car())
            ->setBrand(new Brand())
            ->setModel(new Model())
            ->setPhoto('')
            ->setPrice(10000);
    }

    public static function createModel(): Model
    {
        return (new Model())
            ->setId(1)
            ->setName('Camry');
    }

    public static function createBrand(): Brand
    {
        return (new Brand())
            ->setId(1)
            ->setName('Toyota');
    }



}
