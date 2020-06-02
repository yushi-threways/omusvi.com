<?php
declare(strict_types=1);

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class RateEnumType extends AbstractEnumType
{
    public const PERCENTAGE = 'percentage';
    public const FLAT = 'flat';

    protected static $choices = [
        self::PERCENTAGE => 'パーセンテージ',
        self::FLAT => '定額',
    ];

}
