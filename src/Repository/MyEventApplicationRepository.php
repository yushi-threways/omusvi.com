<?php

namespace App\Repository;

use App\Entity\MyEventApplication;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\DBAL\Types\MyEventApplicationStatusEnumType;

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

    /**
     * @param User $user
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getAppliedEventQuery(User $user)
    {
        $qb = $this->createQueryBuilder('ma');
        $qb->where('ma.user = :user')
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->eq('ma.status', ':APPLIED'),
                    $qb->expr()->eq('ma.status', ':PAIED')
                )
            )
            ->setParameters([
                'user' => $user,
                'APPLIED' => MyEventApplicationStatusEnumType::APPLIED,
                'PAIED' => MyEventApplicationStatusEnumType::PAIED,
            ])
        ;
        
        return $qb;
    }

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
