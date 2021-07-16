<?php


namespace App\Enum;


class KeywordType
{
    const ROCKS = 'rocks';
    const SUCKS = 'sucks';

    private function __construct()
    { /* noop */
    }

    public static function all()
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }

}