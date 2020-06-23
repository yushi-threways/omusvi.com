<?php
declare(strict_types=1);

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class MyEventApplicationPayMentEnumType extends AbstractEnumType
{
    public const BANKTRANSFER = 'bt';
    public const LOCALPAYMENT = 'lp';
    // public const CREDITCARD = 'cc';

    
    protected static $choices = [
        self::BANKTRANSFER => '銀行振込',
        self::LOCALPAYMENT => '現地払い',
        // self::CREDITCARD => 'クレジットカード',
    ];
}
