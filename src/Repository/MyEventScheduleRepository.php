<?php

namespace App\Repository;

use App\Entity\MyEventSchedule;
use App\DBAL\Types\MyEventApplicationStatusEnumType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\PersistentCollection;
use App\Model\SearchFilter\EventSearchFilter;

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
    public function findByEventDay()
    {
        $qb = $this->createQueryBuilder("sc")
            ->where('sc.eventDay >= :now')
            ->orderBy('sc.eventDay', 'ASC')
            ->setParameter('now', new \DateTime())
        ;

        return $qb;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createQueryBuilderBySearchFilter(EventSearchFilter $searchFilter): \Doctrine\ORM\QueryBuilder
    {
        $qb = $this->createQueryBuilder("schedule")
            ->leftJoin('schedule.myEvent', 'event');
        
        $params = [];
        
        if ($searchFilter->getPrefecture()) {
            $qb->andWhere('event.prefecture = :prefecture');
            $params["prefecture"] = $searchFilter->getPrefecture();
        }
    
        if ($searchFilter->getStartDate()) {
            $qb->andWhere(':startDate <= schedule.eventDay');
            $params["startDate"] = $searchFilter->getStartDate()->setTime(0,0);
        }
    
        if ($searchFilter->getEndDate()) {
            $qb->andWhere('schedule.eventDay <= :endDate');
            $params["endDate"] = $searchFilter->getEndDate()->setTime(23,59);
        }
    
        if ($searchFilter->getEventTimeZone() == "day_time") {
            $start = '10:00:00';
            $end = '16:00:00';
            $qb->andWhere(
                $qb->expr()->andX(
                    $qb->expr()->gte('schedule.startTime', ':start'),
                    $qb->expr()->lte('schedule.startTime', ':end')
                )
            );
            $params["start"] = $start;  
            $params["end"] = $end;  
        } elseif ($searchFilter->getEventTimeZone() == "night_time") {
            $start = '16:00:01';
            $end = '23:59:59';
            $qb->andWhere(
                $qb->expr()->andX(
                    $qb->expr()->gte('schedule.startTime', ':start'),
                    $qb->expr()->lte('schedule.startTime', ':end')
                )
            );
            $params["start"] = $start;
            $params["end"] = $end;
        } else {
        }
        
        $qb->orderBy('schedule.eventDay', 'ASC')
            ->setParameters($params);
        
        return $qb;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createQueryBuilderBySearchRequest($tag = null, $startDate = null, $endDate = null, $startTime = null): \Doctrine\ORM\QueryBuilder
    {
        $qb = $this->createQueryBuilder("schedule")
            ->leftJoin('schedule.myEvent', 'event');
        
        $params = [];
        
        if (null !== $tag) {
            $qb->andWhere(':tag MEMBER OF event.tags');
            $params["tag"] = $tag;
        }
    
        if (null !== $startDate && null !== $endDate) {
            $qb->andWhere(
                $qb->expr()->between('schedule.eventDay', ':startDate', ':endDate'),
                $qb->expr()->gte('schedule.eventDay', ':now')
            );
            
            $params["startDate"] = $startDate;
            $params["endDate"] = $endDate;
            $params["now"] = new \DateTime();
        }

        if (null !== $startTime) {
            $qb->andWhere('schedule.startTime > :startTime');
            $params["startTime"] = $startTime;
        }
                
        $qb->orderBy('schedule.eventDay', 'ASC')
            ->setParameters($params);
        
        return $qb;
    }
}
