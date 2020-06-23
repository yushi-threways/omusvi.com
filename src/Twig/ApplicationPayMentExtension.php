<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\DBAL\Types\MyEventApplicationPayMentEnumType;

use App\Entity\MyEventApplication;

class ApplicationPayMentExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('isBt', [$this, 'isBt']),
            new TwigFunction('isLp', [$this, 'isLp']),
            new TwigFunction('get_payment_text', [$this, 'getPaymentText']),
            
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


    public function getPaymentText($paymentType)
    {
        switch ($paymentType){
            case MyEventApplicationPayMentEnumType::BANKTRANSFER:
                echo "銀行振込";
                break;
            case MyEventApplicationPayMentEnumType::LOCALPAYMENT:
                echo "現地払い";
                break;
            // case MyEventApplicationPayMentEnumType::CREDITCARD:
            //     echo "クレジットカード";
            //     break;
            default:
                echo "";
        }
    }

}