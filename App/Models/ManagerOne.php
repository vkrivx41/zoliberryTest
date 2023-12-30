<?php

namespace App\Models;

class ManagerOne
{

    private static array $instances = [];

    private function __construct(public string $username, public string $email, public string $password)
    {

    }


    public static function create(string $username, string $email, string $password): static|null
    {
        if (empty(self::$instances)){
            return new static($username, $email, $password);
        }

        return null;
    }
}