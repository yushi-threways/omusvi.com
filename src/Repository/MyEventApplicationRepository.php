<?php

namespace App\Repository;

use App\Entity\MyEventApplication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MyEventApplication|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyEventApplication|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyEventApplication[]    findAll()
 * @method MyEventApplication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyEventApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyEventApplication::class);
    }

    // /**
    //  * @return MyEventApplication[] Returns an array of MyEventApplication objects
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
    public function findOneBySomeField($value): ?MyEventApplication
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
