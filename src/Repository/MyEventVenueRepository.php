<?php

namespace App\Repository;

use App\Entity\MyEventVenue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MyEventVenue|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyEventVenue|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyEventVenue[]    findAll()
 * @method MyEventVenue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyEventVenueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyEventVenue::class);
    }

    public function findPubliehed()
    {
        return $this->createQueryBuilder('m')
        ->where('m.published = 1')
        ->orderBy('m.name', 'ASC')
        ->getQuery()
        ->getResult()
        ;
    }

    // /**
    //  * @return MyEventVenue[] Returns an array of MyEventVenue objects
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
    public function findOneBySomeField($value): ?MyEventVenue
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
