<?php

namespace App\Repository;

use App\Entity\Accept;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Accept|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accept|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accept[]    findAll()
 * @method Accept[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcceptRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Accept::class);
    }

    // /**
    //  * @return Accept[] Returns an array of Accept objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Accept
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
