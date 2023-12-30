<?php

namespace App\Controllers\UsersControllers;

use App\Attributes\Post;
use App\Models\UserModel;
use JetBrains\PhpStorm\NoReturn;

class UserDataController
{
    public function __construct(
        protected UserModel $userModel
    )
    {
    }

    public function already_exists(): bool
    {
        $id = $_COOKIE['user_id'] ?? null;

        if (! $id){
            return false;
        }

        return true;
    }

    #[NoReturn] #[Post("/User/Create")]
    public function create(): void
    {

        if ($this->already_exists()){
            exit("create_exists");
        }

        if (! $this->userModel->create()){
            exit("create_error");
        }


        $id = $this->userModel->getLastId();
        setcookie("user_id", $id, time() + 60 * 60 * 24 * 30);

        exit("create_done");
    }
}