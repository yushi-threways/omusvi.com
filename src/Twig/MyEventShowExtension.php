<?php

namespace App\Twig;

use App\Entity\MyEvent;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Entity\MyEventApplication;
use App\Entity\MyEventSchedule;
use DateTimeImmutable;

class MyEventShowExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('after_event_date', [$this, 'isAfterEventDate']),
        ];
    }

    public function isAfterEventDate(MyEventSchedule $schedule)
    {
        $eventDay = $schedule->getEventDay()->format('Y-m-d');
        $startTime = $schedule->getStartTime()->format(' H:i:s');
        $eventDateTime = $eventDay . $startTime;
        $current = new DateTimeImmutable();
        $eventDate = new DateTimeImmutable($eventDateTime);
        if ($current > $eventDate) {
            return true;
        } else {
            return false;
        }
    }
}
