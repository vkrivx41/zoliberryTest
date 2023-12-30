<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Models\ManagerModel;
use App\Models\ManagerOne;
use App\Validators\ManagerValidator;
use App\View;

class ManagerRegistrationController extends RegistrationController
{
    public function __construct(
        protected ManagerValidator $validator,
        protected ManagerModel $managerModel
    )
    {
    }


    #[Get('/Dashboard/Register')]
    public function register(): View
    {
        return View::make('/Register/index', 'php', []);
    }

    #[Post('/Dashboard/Register')]
    public function registerHandler(): View
    {

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $rePassword = htmlspecialchars($_POST['re-password']);
        $email = htmlspecialchars($_POST['email']);

        if(! $this->validator->name($username)){
            return View::make('/Register/index', 'php', ['name' => true]);
        };

        if(! $this->validator->email($email)){
            return View::make('/Register/index', 'php', ['email' => true]);
        };

        if(! $this->validator->password($password)){
            return View::make('/Register/index', 'php', ['password' => true]);
        };

        if(! $this->validator->rePassword($password, $rePassword)){
            return View::make('/Register/index', 'php', ['rePassword' => true]);
        };

        if (! $this->managerModel->checkerCount()){
            return View::make('/Register/index', 'php', ['error' => true]);
        }

        $manager = $this->managerModel->register(ManagerOne::create($username, $email, $password));

        var_dump($manager);

        if (! $manager){
            return View::make('/Register/index', 'php', ['error' => true]);
        }

        header("Location: /Dashboard");

    }
}