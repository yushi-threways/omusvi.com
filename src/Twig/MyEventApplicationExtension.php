<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\DBAL\Tyeps\MyEventApplicationStatusEnumType;
use App\Entity\MyEvent;
use App\Entity\MyEventApplication;
use App\Entity\User;

class MyEventApplicationExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('isApplied', [$this, 'isApplied']),
            new TwigFunction('isPaied', [$this, 'isPaied']),
            new TwigFunction('isAccepted', [$this, 'isAccepted']),
            new TwigFunction('isCanceled', [$this, 'isCanceled']),
            new TwigFunction('isRejected', [$this, 'isRejected']),
        ];
    }

    public function isApplied(MyEventApplication $application): bool
    {
        return $application->isApplied();
    }
    public function isPaied(MyEventApplication $application): bool
    {
        return $application->isPaied();
    }
    public function isAccepted(MyEventApplication $application): bool
    {
        return $application->isAccepted();
    }
    public function isCanceled(MyEventApplication $application): bool
    {
        return $application->isCanceled();
    }
    public function isRejected(MyEventApplication $application): bool
    {
        return $application->isRejected();
    }
}
