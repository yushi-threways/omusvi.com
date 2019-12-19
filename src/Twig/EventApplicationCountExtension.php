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
            new TwigFunction('countApplied', [$this, 'countApplied']),
            new TwigFunction('countAccepted', [$this, 'countAccepted']),
            new TwigFunction('countAcceptMaleCount', [$this, 'countAcceptMaleCount']),
            new TwigFunction('countAcceptFemaleCount', [$this, 'countAcceptFemaleCount']),
        ];
    }

    public function countApplied(MyEventSchedule $myEventSchedule)
    {
        $applications = $myEventSchedule->getMyEventApplications();
        $appliedCount = 0;
        $appliedMaleCount = 0;
        $appliedFemaleCount = 0;
        foreach($applications as $application) {
            if ($application->getStatus() == MyEventApplicationStatusEnumType::APPLIED) {
                $appliedMaleCount += $application->getMenCount();
                $appliedFemaleCount += $application->getWomanCount();
                $appliedCount = $appliedMaleCount + $appliedFemaleCount;
            }
        }
        return $appliedCount;
    }

    public function countAccepted(MyEventSchedule $myEventSchedule)
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

    public function countAcceptMaleCount(MyEventSchedule $myEventSchedule): ?int
    {
        $applications = $myEventSchedule->getMyEventApplications();
        $maleCount = 0;
        foreach($applications as $application) {
            if ($application->getStatus() == MyEventApplicationStatusEnumType::ACCEPTED) {
                $maleCount += $application->getMenCount();
            }
        }
        
        return $maleCount;
     }

    public function countAcceptFemaleCount(MyEventSchedule $myEventSchedule): ?int
    {
        $applications = $myEventSchedule->getMyEventApplications();
        $femaleCount = 0;
        foreach($applications as $application) {
            if ($application->getStatus() == MyEventApplicationStatusEnumType::ACCEPTED) {
                $femaleCount += $application->getWomanCount();
            }
        }
        return $femaleCount;
    }
}
