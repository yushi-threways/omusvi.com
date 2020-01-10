<?php

namespace App\Repository\Criteria;

use App\Entity\Tag;
use App\Entity\Prefecture;
use Doctrine\Common\Collections\Criteria;

/**
 * Class MyEventCriteria
 * @package App\Repository\Criteria
 */
class MyEventCriteria
{
    public static function eventTag(Tag $tag)
    {
        return Criteria::create()->where(Criteria::expr()->in($tag, 'myEvent.tags'));
    }
    
    public static function prefecture(Prefecture $prefecture)
    {
        return Criteria::create()->where(Criteria::expr()->eq('myEvent.prefecture', $prefecture));
    }
}
