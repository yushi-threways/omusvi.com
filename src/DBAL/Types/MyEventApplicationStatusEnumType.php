<?php
declare(strict_types=1);

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class MyEventApplicationStatusEnumType extends AbstractEnumType
{
    public const APPLIED = 'applied';
    public const CANCELED = 'canceled';
    public const ACCEPTED = 'accepted';
    public const REJECTED = 'rejected';

    protected static $choices = [
        self::APPLIED => 'ユーザー申し込み',
        self::CANCELED => 'キャンセル',
        self::ACCEPTED => '申し込み完了',
        self::REJECTED => '却下',
    ];
}
