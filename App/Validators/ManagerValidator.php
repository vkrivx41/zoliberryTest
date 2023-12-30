<?php

namespace App\Validators;


class ManagerValidator extends ParentValidator
{
    public function name(string $username): bool
    {
        return $this->lengthy($username, 6);
    }

    public function password(string $password): bool
    {
        return $this->lengthy($password, 7);
    }

    public function rePassword(string $password, string $rePassword): bool
    {
        return $this->similarity($password, $rePassword);
    }

    public function email(string $email): bool
    {
        return $this->patterner($email, '@');
    }

    public function phone(string $phone): bool{
        return $this->lengthy($phone, 10);
    }

    public function type(string $type, array $list): bool
    {
        return $this->arrayChecker($type, $list);
    }

    public function size(int $size, int $limit): bool
    {
        $size = $size / 1024 / 1024;

        return $this->sizeChecker($size, $limit);
    }
}