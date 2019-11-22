<?php

namespace App\Repository;

use App\Entity\MyEvent;
use App\Entity\MyEventApplication;
use App\Entity\User;
use App\Entity\MyEventSchedule;
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
        $qb->innerJoin('ma.myEventSchedule', 'ms')
            ->where('ms.eventDay >= :now')
            ->andWhere('ma.user = :user')
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->eq('ma.status', ':APPLIED'),
                    $qb->expr()->eq('ma.status', ':PAIED')
                )
            )
            ->setParameters([
                'now' => new \DateTime(),
                'user' => $user,
                'APPLIED' => MyEventApplicationStatusEnumType::APPLIED,
                'PAIED' => MyEventApplicationStatusEnumType::PAIED,
            ])
        ;
        
        return $qb;
    }

    /**
    * @param User $user
    * @return \Doctrine\ORM\QueryBuilder
    */
    public function getAcceptedEventQuery(User $user)
    {
        $qb = $this->createQueryBuilder('ma');
        $qb->innerJoin('ma.myEventSchedule', 'ms')
            ->where('ms.eventDay >= :now')
            ->andWhere('ma.user = :user')
            ->andWhere(
                $qb->expr()->eq('ma.status', ':ACCEPTED')
            )
            ->setParameters([
                'now' => new \DateTime(),
                'user' => $user,
                'ACCEPTED' => MyEventApplicationStatusEnumType::ACCEPTED,
            ])
        ;
        
        return $qb;
    }

    /**
     * @param User $user
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getAdminAppliedEventQuery(MyEventSchedule $my_event_schedule)
    {
        $qb = $this->createQueryBuilder('ma');
        $qb->where('ma.myEventSchedule = :my_event_schedule')
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->eq('ma.status', ':APPLIED'),
                    $qb->expr()->eq('ma.status', ':PAIED')
                )
            )
            ->setParameters([
                'now' => new \DateTime(),
                'APPLIED' => MyEventApplicationStatusEnumType::APPLIED,
                'PAIED' => MyEventApplicationStatusEnumType::PAIED,
            ])
        ;

        return $qb;
    }
}
