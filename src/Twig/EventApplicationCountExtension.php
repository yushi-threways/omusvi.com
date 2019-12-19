<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\DBAL\Tyeps\MyEventApplicationStatusEnumType;
use App\Entity\MyEventSchedule;

class EventApplicationCountExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('countApplications', [$this, 'countApplications']),
        ];
    }

    public function countApplications(MyEventSchedule $myEventSchedule)
    {
        $applications = $myEventSchedule->getMyEventApplications();
        $acceptCount = 0;
        $acceptMaleCount = 0;
        $acceptFemaleCount = 0;
        foreach($applications as $application) {
            if ($application->getStatus() == MyEventApplicationStatusEnumType::ACCEPTED) {
                $acceptMaleCount += $application->getMenCount();
                $acceptFemaleCount += $application->getWomanCount();
                $acceptCount = $acceptMaleCount + $acceptFemaleCount;
            }
        }
        return $acceptCount;
    }
    
    
}
