<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use DateTimeImmutable;

class MyEventShowExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('after_event_date', [$this, 'isAfterEventDate']),
        ];
    }

    /**
     * @param $myEventStartAt
     * @return bool
     */
    public function isAfterEventDate($myEventStartAt)
    {
        $eventStartAt = $myEventStartAt;
        $current = new DateTimeImmutable();
        if ($current > $eventStartAt) {
            return true;
        }
        return false;
    }
}
