<?php

namespace App\Repository;

use App\Entity\BankAccount;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BankAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method BankAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method BankAccount[]    findAll()
 * @method BankAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BankAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BankAccount::class);
    }

    public function findOrCreateByUser(User $user)
    {
        $account = $this->findOneBy(['user' => $user]);
        
        if (!$account) {
            $account = new BankAccount();
            $account->setUser($user);
        }
        
        return $account;
    }


    // /**
    //  * @return BankAccount[] Returns an array of BankAccount objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BankAccount
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
