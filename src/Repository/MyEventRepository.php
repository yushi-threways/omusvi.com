<?php

namespace App\Repository;

use App\Entity\MyEvent;
use App\Entity\Tag;
use App\Entity\MyEventSchedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MyEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyEvent[]    findAll()
 * @method MyEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyEvent::class);
    }

    public function findTagEvent(Tag $tag = null, $limit = null)
    {

        $qb = $this->createQueryBuilder('mt')
            ->addSelect('t')
            ->leftJoin('mt.tags', 't')
            ->innerJoin('mt.myEventSchedule', 'ms')
            ->where('ms.eventDay >= :now')
            ->orderBy('mt.createdAt', 'DESC')
            ->setParameter('now', new \Datetime())
            ->setMaxResults($limit)
            // ->setParameter('now', $data->modify('-2 months'))
        ;

        if (null !== $tag) {
            $qb->andWhere(':tag MEMBER OF mt.tags')
                ->setParameter('tag', $tag);
        }
    
        return $qb->getQuery()->getResult();
    }

     /**
      * @return MyEvent[] Returns an array of MyEvent objects
      */
    public function findLatestEvent($limit = null)
    {
        $qb = $this->createQueryBuilder("m");
        $qb->innerJoin('m.myEventSchedule', 'ms')
            ->where('ms.eventDay >= :now')
            ->orderBy('ms.eventDay', 'DESC')
            ->setParameter('now', new \DateTime())
            ->setMaxResults($limit)
            ;


        return $qb->getQuery()->getResult();
    }

    /**
     * @return MyEvent[] Returns an array of MyEvent objects
     */
    public function findLBeforeEvent($limit = null)
    {
        $qb = $this->createQueryBuilder("m");
        $qb->innerJoin('m.myEventSchedule', 'ms')
            ->where('ms.eventDay >= :now')
            ->orderBy('ms.eventDay', 'DESC')
            ->setParameter('now', new \DateTime())
            ->setMaxResults($limit)
        ;


        return $qb->getQuery()->getResult();
    }

    /**
     * @return MyEvent[] Returns an array of MyEvent objects
     */
    public function findLAfterEvent($limit = null)
    {
        $qb = $this->createQueryBuilder("m");
        $qb->innerJoin('m.myEventSchedule', 'ms')
            ->where('ms.eventDay <= :now')
            ->orderBy('ms.eventDay', 'DESC')
            ->setParameter('now', new \DateTime())
            ->setMaxResults($limit)
        ;


        return $qb->getQuery()->getResult();
    }

    /*
    public function findOneBySomeField($value): ?MyEvent
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
