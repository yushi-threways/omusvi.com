<?php

namespace App\Repository;

use App\Entity\MyEventSchedule;
use App\DBAL\Types\MyEventApplicationStatusEnumType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\PersistentCollection;

/**
 * @method MyEventSchedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyEventSchedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyEventSchedule[]    findAll()
 * @method MyEventSchedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyEventScheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyEventSchedule::class);
    }

    // /**
    //  * @return MyEventSchedule[] Returns an array of MyEventSchedule objects
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
    public function findOneBySomeField($value): ?MyEventSchedule
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
