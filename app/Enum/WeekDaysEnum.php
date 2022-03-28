<?php

/**
 * Created by PhpStorm.
 * User: rami
 * Date: 2/7/19
 * Time: 8:19 PM
 */

namespace App\Enum;

abstract class WeekDaysEnum
{
    public const SUNDAY = 1;

    public const MONDAY = 2;

    public const TUESDAY = 3;

    public const WEDNESDAY = 4;

    public const THURSDAY = 5;

    public const FRIDAY = 6;

    public const SATURDAY = 7;

    public static function toArray()
    {
        return [
            static::SUNDAY,
            static::MONDAY,
            static::TUESDAY,
            static::WEDNESDAY,
            static::THURSDAY,
            static::FRIDAY,
            static::SATURDAY,
        ];
    }

    public static function getConstantByName($dayName)
    {
        return constant('self::'.$dayName);
    }
}
