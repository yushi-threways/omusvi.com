<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\DBAL\Tyeps\MyEventApplicationPayMentEnumType;
use App\Entity\MyEventApplication;

class ApplicationPayMentExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('isBt', [$this, 'isBt']),
            new TwigFunction('isLp', [$this, 'isLp']),
            
        ];
    }

    public function isBt(MyEventApplication $application): bool 
    {
        return $application->isBt();
  
    }
    public function isLp(MyEventApplication $application): bool 
    {
        return $application->isLp();
    }
}