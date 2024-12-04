<?php

namespace App\Tests\Service;

use App\Entity\Car;
use App\Model\CarDetails;
use App\Repository\CarRepository;
use App\Service\CarService;
use App\Tests\AbstractTestCase;
use App\Tests\MockUtils;
use App\Model\BrandList as CollectListModel;

class CarServiceTest extends AbstractTestCase
{

    private CarRepository $carRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->carRepository = $this->createMock(CarRepository::class);
    }

    public function testGetCarById(): void
    {
        $car = $this->createCarEntity();

        $this->carRepository->expects($this->once())
            ->method('getCarById')
            ->with(123)
            ->willReturn($car);

        $expected = (new CarDetails())->setId(123)
            ->setId(123)
            ->setBrand([123, 'Toyota'])
            ->setModel([123, 'Camry'])
            ->setPhoto('')
            ->setPrice(10000);

        $this->assertEquals($expected, $this->createCarService()->getCarById(123));
    }

    private function createCarService(): CarService
    {
        return new CarService(
            $this->carRepository
        );
    }

    private function createCarEntity(): Car
    {

        $car = MockUtils::createCar();
        $this->setEntityId($car, 123);

        $model = MockUtils::createModel();
        $this->setEntityId($model, 123);

        $brand = MockUtils::createBrand();
        $this->setEntityId($brand, 123);

        $car->setBrand($brand);
        $car->setModel($model);

        return $car;
    }
}
