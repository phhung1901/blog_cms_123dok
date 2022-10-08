<?php


namespace App\Models\Enums;


use MyCLabs\Enum\Enum;

abstract class MyEnum extends Enum
{
    public static function toOptions() : array {
        return array_flip(self::toArray());
    }
}
