<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Doctrine\ORM\EntityManagerInterface;

class TwigDate extends AbstractExtension
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('get_sat', [$this, 'getSatday']),
            new TwigFunction('get_sun', [$this, 'getSunday']),            
        ];
    }

    public function getSatday(): ?\DateTime
    {
        $now = new \DateTime();
        $w = (int)$now->format('w');
        $diff = 6 - $w;
        
        $sat = $now->add(new \DateInterval('P' . $diff . 'D'));
        
        return $sat;
    }

    public function getSunday(): ?\DateTime
    {
        $now = new \DateTime();    // 今日
        $w = (int)$now->format('w');
        $diff = 6 - $w;
        
        $sun = $now->add(new \DateInterval('P' . ($diff + 1)  . 'D'));

        return $sun;
    }
}
