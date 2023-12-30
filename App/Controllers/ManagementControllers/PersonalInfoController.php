<?php

namespace App\Controllers\ManagementControllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Controllers\RegistrationController;
use App\Controllers\SessionController;
use App\Models\ManagerModel;
use App\Validators\ManagerValidator;
use App\View;

class PersonalInfoController extends RegistrationController
{

    public function __construct(
        protected ManagerValidator $validator,
        protected ManagerModel $managerModel,
        protected SessionController $session
    )
    {
    }

    #[Get('/Dashboard/Manage/Personal-info')]
    public function personal(): View
    {
        if (! $this->session->checkManagerSession()){
            header('Location: /Dashboard/Login/manager');
        }

        $managerData = $this->managerModel->managerAndDemo();


        return View::make("Manage/personal", 'php', ['manager' => $managerData]);
    }

    #[Post('/Dashboard/Manage/Personal-info')]
    public function controlManager(): View
    {

        $managerData = $this->managerModel->managerAndDemo();

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $rePassword = htmlspecialchars($_POST['re-password']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);

        $demo = [
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'phone' => $phone,
        ];

        if(! $this->validator->name($username)){
            return View::make('/Manage/Personal', 'php', ['name' => true, 'manager' => $managerData]);
        };

        if(! $this->validator->email($email)){
            return View::make('/Manage/Personal', 'php', ['email' => true, 'manager' => $managerData]);
        };

        if(! $this->validator->phone($phone)){
            return View::make('/Manage/Personal', 'php', ['phone' => true, 'manager' => $managerData]);
        };

        if(! $this->validator->password($password)){
            return View::make('/Manage/Personal', 'php', ['password' => true, 'manager' => $managerData]);
        };

        if(! $this->validator->rePassword($password, $rePassword)){
            return View::make('/Manage/Personal', 'php', ['rePassword' => true, 'manager' => $managerData]);
        };


        return $this->uploadProfile($demo);
    }

    public function uploadProfile(array $demo): View
    {
        $managerData = $this->managerModel->managerAndDemo();

        $name = $_FILES['profile']['name'];
        $type = explode('.', $name)[1] ?? 'jpg';
        $size = $_FILES['profile']['size'];
        $error = $_FILES['profile']['error'];
        $temp = $_FILES['profile']['tmp_name'];


        if (! $this->validator->type($type, $this->eligibleTypes)){
            return View::make('/Manage/Personal', 'php', ['type' => true, 'manager' => $managerData]);
        }

        if (! $this->validator->size($size, $_ENV['IMAGE_SIZE'])){
            return View::make('/Manage/Personal', 'php', ['size' => true, 'manager' => $managerData]);
        }

        if ($error !== 0){
            return View::make('/Manage/Personal', 'php', ['error' => true, 'manager' => $managerData]);
        }

        $uploadDir = 'images/Profiles/Manager';
        $name = 'profile.'.$type;

        if (! move_uploaded_file($temp, $uploadDir.'/'.$name)){
            return View::make('/Manage/Personal', 'php', ['upload' => true, 'manager' => $managerData]);
        }

        if (! $this->managerModel->addDemo($name, $demo['phone'])){
            return View::make('/Manage/Personal', 'php', ['demo' => true, 'manager' => $managerData]);
        }

        if (! $this->managerModel->updateData($demo)){
            return View::make('/Manage/Personal', 'php', ['data' => true, 'manager' => $managerData]);
        }

        return View::make('/Manage/Personal', 'php', ['manager' => $managerData]);
    }
}