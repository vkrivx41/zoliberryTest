<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Models\ManagerModel;
use App\View;

class ManagerLoginController
{
    public function __construct(
        protected ManagerModel $managerModel,
        protected SessionController $sessionController
    )
    {
    }

    #[Get('/Dashboard/Login/manager')]
    public function login(): View
    {
        return View::make('/login/manager', 'php', []);
    }

    #[Post('/Dashboard/Login/manager')]
    public function loginHandler(): View
    {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if (! $this->managerModel->checkUserNameOrEmail($username)){
            return View::make('/login/manager', 'php', ['name' => true]);
        }

        if (! $this->managerModel->checkPassword($password)){
            return View::make('/login/manager', 'php', ['password' => true]);
        }

        if (! $this->sessionController->manager($username)){
            return View::make('/login/manager', 'php', ['session' => true]);
        }

        return View::make('/login/pass', 'php', []);
    }
}