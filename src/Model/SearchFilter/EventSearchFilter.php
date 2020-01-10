<?php

namespace App\Model\SearchFilter;

// use App\Entity\JobCategory;
use App\Entity\Prefecture;
use App\Entity\tag;
use App\Repository\Criteria\MyEventScheduleCriteria;
use App\Repository\Criteria\MyEventCriteria;

class EventSearchFilter
{

    /**
     * @var Prefecture
     */
    private $prefecture;
    
    /**
     * @var Tag
     */
    private $tag;

    /**
     * @var \DateTime
     */
    private $startTime;

    /**
     * @var \DateTime
     */
    private $endTime;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var string
     */
    private $eventTimeZone;

    /**
     * @return Prefecture
     */
    public function getPrefecture(): ?Prefecture
    {
        return $this->prefecture;
    }

    /**
     * @param Prefecture $prefecture
     */
    public function setPrefecture(Prefecture $prefecture): self
    {
        $this->prefecture = $prefecture;
        return $this;
    }

    /**
     * @return Tag
     */
    public function getTag(): ?Tag
    {
        return $this->tag;
    }

    /**
     * @param Tag $tag
     */
    public function setTag(Tag $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStartTime(): ?\DateTime
    {
        return $this->startTime;
    }

    /**
     * @param \DateTime $startTime
     */
    public function setStartTime(?\DateTime $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndTime(): ?\DateTime
    {
        return $this->endTime;
    }

    /**
     * @param \DateTime $endTime
     */
    public function setEndTime(?\DateTime $endTime): self
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(?\DateTime $startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(?\DateTime $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getEventTimeZone(): ?string
    {
        return $this->eventTimeZone;
    }

    /**
     * @param string $eventTimeZone
     */
    public function setEventTimeZone(string $eventTimeZone): self
    {
        $this->eventTimeZone = $eventTimeZone;
        return $this;
    }
    
    public function toCriteria()
    {
        $criteria = [];
    
        if ($this->tag)
        {
            $criteria[] = MyEventCriteria::eventTag($this->tag);
        }

        if ($this->prefecture)
        {
            $criteria[] = MyEventCriteria::prefecture($this->prefecture);
        }
    
        if ($this->startDate && $this->endDate) {
            $criteria[] = MyEventScheduleCriteria::dateBetween($this->startDate, $this->endDate);
        } else {
            if ($this->startDate)
            {
                $criteria[] = MyEventScheduleCriteria::dateStartAfter($this->startDate);
            }
    
            if ($this->endDate)
            {
                $criteria[] = MyEventScheduleCriteria::dateEndBefore($this->endDate);
            }
        }
    
        if ($this->eventTimeZone = "day_time")
        {
            $criteria[] = MyEventScheduleCriteria::startDayTime($this->startTime);
        } elseif ($this->eventTimeZone = "night_time") {
            $criteria[] = MyEventScheduleCriteria::startNightTime($this->starTime);
        } else {

        }
        
        return $criteria;
    }
}
