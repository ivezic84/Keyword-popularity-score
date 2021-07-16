<?php


namespace App\Enum;


class ProviderType
{
    const GIT_HUB = 'git_hub';
    const TWITTER = 'twitter';

    private function __construct()
    { /* noop */
    }

    public static function all()
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }

}