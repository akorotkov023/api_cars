<?php

namespace App\Tests\Service;

use App\Entity\Car;
use App\Model\CarDetails;
use App\Model\CarListItem;
use App\Model\CarListResponse;
use App\Repository\CarRepository;
use App\Service\CarService;
use App\Tests\AbstractTestCase;
use App\Tests\MockUtils;

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

    public function testGetCars(): void
    {
        $car1 = $this->createCarEntity();
        $car2 = $this->createCarEntity();
        $this->carRepository->method('findAll')->willReturn([$car1, $car2]);

        $response = $this->createCarService()->getCars();

        $this->assertInstanceOf(CarListResponse::class, $response);
        $this->assertCount(2, $response->getItems());
    }
}
