<?php

namespace App\Twig;

use App\Entity\MyEvent;
use App\Entity\MyEventTicket;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\DBAL\Types\MyEventApplicationStatusEnumType;
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

    public function countMaleTickets(MyEvent $myEvent)
    {
        // Entityに男女別でチケットを取得するメソッドを作成
        // 取得した複数のチケットのsalesの合計を集計
        // その合計をMyEventのseats数で引き算（残席数が出る）
        // 残席数とチケットの単位を計算して残席数を超えるものは購入不可(btnにdisableを追加)
        //

    }

    public function 女性チケット取得()
    {

    }

    public function 男性チケット取得()
    {

    }

    public function 女性席残数取得()
    {

    }

    public function 男性席残数取得()
    {

    }
}
