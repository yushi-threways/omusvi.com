<?php

namespace App\Repository;

use App\Entity\MyEvent;
use App\Entity\Tag;
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

    public function findTagEvent(Tag $tag = null)
    {

        $qb = $this->createQueryBuilder('mt')
            ->addSelect('t')
            ->leftJoin('mt.tags', 't')
            ->where('mt.createdAt <= :now')
            ->orderBy('mt.createdAt', 'DESC')
            ->setParameter('now', new \Datetime())
            // ->setParameter('now', $data->modify('-2 months'))
        ;

        if (null !== $tag) {
            $qb->andWhere(':tag MEMBER OF mt.tags')
                ->setParameter('tag', $tag);
        }
    
        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return MyEvent[] Returns an array of MyEvent objects
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
