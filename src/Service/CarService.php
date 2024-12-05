<?php

namespace App\Service;

use App\Entity\Car;
use App\Exception\CarsNotFoundException;
use App\Mapper\CarMapper;
use App\Model\CarDetails;
use App\Model\CarListItem;
use App\Model\CarListResponse;
use App\Repository\CarRepository;

readonly class CarService
{

    public function __construct(
        private CarRepository $carRepository,
    ){}

    public function getCars(): CarListResponse
    {
        $cars = $this->carRepository->findAll();

        if (!$cars) {
            throw new CarsNotFoundException();
        }

        return new CarListResponse(array_map(
            function (Car $car) {
                $item = new CarListItem();
                CarMapper::map($car, $item);

                return $item;
            },
            $cars
        ));
    }

    public function getCarById(int $id): CarDetails
    {
        $car = $this->carRepository->getCarById($id);
        $details = new CarDetails();

        CarMapper::map($car, $details);

        return $details;
    }

}
