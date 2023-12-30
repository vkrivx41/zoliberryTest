<?php

namespace App\Validators;

class ParentValidator
{
    public function lengthy(string $item, int $min, int $max = 30): bool
    {
        if (strlen($item) < $min || strlen($item) > $max){
            return false;
        }

        return true;
    }

    public function similarity(string $item1, string $item2): bool
    {
        if ($item1 !== $item2) return false;
        return true;
    }

    public function patterner(string $item, string $pattern): bool
    {
        if (! str_contains($item, $pattern)) return false;
        return true;
    }

    public function arrayChecker(string $needle, array $haystack): bool
    {
        if (! in_array($needle, $haystack)){
            return false;
        }

        return true;
    }

    public function sizeChecker(int $size, int $limit): bool
    {
        if ($size > $limit) return false;
        return true;
    }
}