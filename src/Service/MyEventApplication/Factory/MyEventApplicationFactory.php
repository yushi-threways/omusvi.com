<?php

namespace App\Service\MyEventApplication\Factory;

use App\Entity\MyEventTicket;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\MyEventApplication;

/**
 * Class MyEventApplicationFactory
 * @package App\Service\MyEventApplication
 */
abstract class MyEventApplicationFactory
{
    protected $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    abstract public function userApplicationCreate(User $user, MyEventTicket $myEventTicket, $paymentType): MyEventApplication;
}
