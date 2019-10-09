<?php
declare(strict_types=1);

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class GenderEnumType extends AbstractEnumType
{
    public const MALE = 'male';
    public const FEMALE = 'female';

    protected static $choices = [
        self::MALE => '男性',
        self::FEMALE => '女性',
    ];

}
