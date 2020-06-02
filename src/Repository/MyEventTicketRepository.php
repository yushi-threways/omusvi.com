<?php

namespace App\Repository;

use App\Entity\MyEventTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MyEventTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyEventTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyEventTicket[]    findAll()
 * @method MyEventTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyEventTicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyEventTicket::class);
    }

    // /**
    //  * @return MyEventTicket[] Returns an array of MyEventTicket objects
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
    public function findOneBySomeField($value): ?MyEventTicket
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
