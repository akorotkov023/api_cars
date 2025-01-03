<?php

namespace App\Repository;

use App\Entity\Car;
use App\Exception\CarNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function getCarById($id): ?Car
    {
        $car = $this->createQueryBuilder('c')
            ->andWhere('c.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $car) {
            throw new CarNotFoundException();
        }
        return $car;
    }

    public function existsById(int $id): bool
    {
        return null !== $this->find($id);
    }
//
//    public function getCars(): array
//    {
//        $car = $this->createQueryBuilder('c')
//            ->andWhere('c.id = :val')
//            ->setParameter('val')
//            ->getQuery()
//            ->getResult();
//
//        if (null === $car) {
//            throw new CarNotFoundException();
//        }
//        return $car;
//    }

    //    public function findOneBySomeField($value): ?Car
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
