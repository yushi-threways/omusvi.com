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

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createQueryBuilderBySearchFilter(): \Doctrine\ORM\QueryBuilder
    {
        
        $qb = $this->createQueryBuilder("schedule")
            ->leftJoin('schedule.myEvent', 'event');
        
        $params = [];
        
        if ($searchFilter->getStartDate()) {
            $qb->andWhere(':startDate < schedule.date');
            $params["startDate"] = $searchFilter->getStartDate();
        }
        
        $qb->setParameters($params);
        
        return $qb;
    }
}
