<?php

namespace App\Service;

use App\Mapper\CarMapper;
use App\Model\CarDetails;
use App\Repository\CarRepository;

readonly class CarService
{

    public function __construct(
        private CarRepository   $carRepository,
    ){}


    public function getCarById(int $id): CarDetails
    {
        $car = $this->carRepository->getPublishedById($id);
        $details = new CarDetails();

        CarMapper::map($car, $details);

        return $details;
    }

}
