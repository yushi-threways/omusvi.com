<?php

namespace App\Service\MyEventApplication\Factory;

use App\Entity\User;
use App\Entity\MyEventTicket;
use App\Entity\MyEventApplication;
use App\DBAL\Types\MyEventApplicationStatusEnumType;
use App\DBAL\Types\MyEventApplicationPayMentEnumType;

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
    public function userApplicationCreate(User $user, MyEventTicket $myEventTicket, $paymentType):MyEventApplication
    {
        $application = new MyEventApplication();
        $application->setUser($user);
        $application->setMyEventTicket($myEventTicket);
        
        
        if ($this->isBanktransfer($paymentType)) {
            $application->setStatus(MyEventApplicationStatusEnumType::APPLIED);
        }

        $this->addTicketSales($myEventTicket);

        $this->entityManager->persist($application);
        $this->entityManager->flush();
        
        return $application;
    }

    /**
     * @param [type] $paymentType
     * @return boolean
     */
    public function isBanktransfer($paymentType): bool
    {
        return $paymentType == MyEventApplicationPayMentEnumType::BANKTRANSFER;
    }

    public function addTicketSales(MyEventTicket $myEventTicket)
    {
        $myEventTicket = $myEventTicket->addSales();
        $this->entityManager->persist($myEventTicket);
    }
}
