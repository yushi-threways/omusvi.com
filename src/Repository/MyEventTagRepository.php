<?php

namespace App\Repository;

use App\Entity\MyEventTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MyEventTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyEventTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyEventTag[]    findAll()
 * @method MyEventTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyEventTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyEventTag::class);
    }

    // /**
    //  * @return MyEventTag[] Returns an array of MyEventTag objects
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
    public function findOneBySomeField($value): ?MyEventTag
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
