<?php

namespace App\Repository;

use App\Entity\MyEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MyEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyEvent[]    findAll()
 * @method MyEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyEventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MyEvent::class);
    }

    // /**
    //  * @return MyEvent[] Returns an array of MyEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MyEvent
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
