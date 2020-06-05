<?php

namespace App\Service\MyEventApplication\Factory;

use App\Entity\MyEventApplication;
use App\Entity\MyEventTicket;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserMyEventApplicationFactory
 * @package App\Service\MyEvntApplication
 */
class UserMyEventApplicationFactory extends MyEventApplicationFactory
{
    
    /**
     * @param User $user
     * @param MyEventTicket $myEventTicket
     * @return MyEVentApplication
     */
    public function create(User $user, MyEventTicket $myEventTicket)
    {
        $application = new MyEventApplication();
        $application->setUser($user);
        $application->setMyEventTicket($myEventTicket);
        
        $this->entityManager->persist($application);
        $this->entityManager->flush();
        
        return $application;
    }
}
