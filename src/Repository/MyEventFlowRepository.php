<?php

namespace App\Repository;

use App\Entity\MyEventFlow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MyEventFlow|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyEventFlow|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyEventFlow[]    findAll()
 * @method MyEventFlow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyEventFlowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyEventFlow::class);
    }

    // /**
    //  * @return MyEventFllow[] Returns an array of MyEventFllow objects
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
    public function findOneBySomeField($value): ?MyEventFllow
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
