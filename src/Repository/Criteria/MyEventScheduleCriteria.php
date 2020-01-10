<?php

namespace App\Repository\Criteria;

use Doctrine\Common\Collections\Criteria;

/**
 * @package App\Repository\Criteria
 */
class MyEventScheduleCriteria
{
    public static function dateStartAfter(\DateTime $date)
    {
        return Criteria::create()->where(Criteria::expr()->gte('date', $date));
    }
    
    public static function dateEndBefore(\DateTime $date)
    {
        return Criteria::create()->where(Criteria::expr()->lte('date', $date));
    }
    
    public static function dateBetween(\DateTime $start, \DateTime $end)
    {
        return Criteria::create()->where(Criteria::expr()->andX(
            Criteria::expr()->gte('date', $start),
            Criteria::expr()->lte('date', $end)
        ));
    }
    
    public static function timeStartAfter(\DateTime $time)
    {
        return Criteria::create()->where(Criteria::expr()->gte('startTime', $time));
    }
    
    public static function timeEndBefore(\DateTime $time)
    {
        return Criteria::create()->where(Criteria::expr()->lte('endTime', $time));
    }

    public static function startDayTime()
    {
        return Criteria::create()->where(Criteria::expr()->andX(
            Criteria::expr()->gte('time', '10:00:00'),
            Criteria::expr()->lte('time', '16:00:00')
        ));
    }

    public static function startNightTime()
    {
        return Criteria::create()->where(Criteria::expr()->andX(
            Criteria::expr()->gte('time', '16:00:01'),
            Criteria::expr()->lte('time', '22:00:00')
        ));
    }
}
