<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\DBAL\Types\MyEventApplicationStatusEnumType;
use App\Entity\MyEventSchedule;

class EventApplicationStatusExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('status_text', [$this, 'getStatusText']),
           
        ];
    }

    /**
     * Undocumented function
     *
     * @param $status
     */
    public function getStatusText($status)
    {
        switch ($status){
            case MyEventApplicationStatusEnumType::APPLIED:
                echo "申込中";
                break;
            case MyEventApplicationStatusEnumType::PAIED:
                echo "支払い確認";
                break;
            case MyEventApplicationStatusEnumType::ACCEPTED:
                echo "申込完了";
                break;
            case MyEventApplicationStatusEnumType::CANCELED:
                echo "キャンセル";
                break;
            case MyEventApplicationStatusEnumType::REJECTED:
                echo "却下済";
                break;
            default:
                echo "";
            }
    }
}
