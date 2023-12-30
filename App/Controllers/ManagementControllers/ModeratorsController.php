<?php

namespace App\Controllers\ManagementControllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Controllers\RegistrationController;
use App\Controllers\SessionController;
use App\Models\ModeratorsModel;
use App\Models\Stats;
use App\Validators\ParentValidator;
use App\View;
use JetBrains\PhpStorm\NoReturn;

class ModeratorsController extends RegistrationController
{
    public function __construct(
        protected ModeratorsModel $model,
        protected SessionController $session,
        protected ParentValidator $validator,
        protected Stats $stats
    )
    {
    }



    #[Get('/Dashboard/Moderator')]
    public function moderators(): View
    {
        if (! $this->session->checkModeratorsSession()){
            header('Location: /Dashboard/Login/Moderator');
        }

        $username = $_SESSION['moderator'] ?? null;
        $data = $this->model->moderator($username);

        if (! $data){
            header('Location: /Dashboard/Login/Moderator');
        }

        return View::make("/Dashboard/Moderators/index", 'php', ['data' => $data]);
    }


    #[Get('/Dashboard/Login/Moderator')]
    public function login(): View
    {
        return View::make('/login/moderator', 'php', []);
    }


    #[Post('/Dashboard/Login/Moderator')]
    public function loginHandler(): View
    {
        $username = htmlspecialchars($_POST['username']);
        $password = (string) htmlspecialchars($_POST['password']);

        if ($this->model->checkName($username)){
            return View::make('/login/moderator', 'php', ['name' => true]);
        }

        if (! $this->model->checkPassword($password, $username)){
            return View::make('/login/moderator', 'php', ['password' => true]);
        }

        if (! $this->session->moderator($username)){
            return View::make('/login/moderator', 'php', ['session' => true]);
        }

        return View::make('/login/pass.moderator', 'php', []);
    }


    #[Get('/Dashboard/Manage/Moderators')]
    public function manageModerators(): View
    {
        if (! $this->session->checkManagerSession()){
            header('Location: /Dashboard/Login/manager');
        }

        $data = $this->model->all();
//

        return View::make("Manage/moderators", 'php', ['data' => $data]);
    }


    #[Get('/Dashboard/Create/Moderator')]
    public function createModerator(): View
    {
        return View::make('/create/Moderator/index', 'php', []);
    }

    #[Post('/Dashboard/Create/Moderator')]
    public function handleModerator(): View
    {
        return $this->handler('/create/Moderator/index', $_POST);
    }

    public function addToDatabase(array $data): View
    {
        if (! $this->model->checkName($data['username']))
        {
            return View::make('/create/Moderator/index', 'php', ['reName' => true]);
        }

        if (! $this->model->create($data)){
            return View::make('/create/Moderator/index', 'php', ['error' => true]);
        }

        return View::make('/create/Moderator/index', 'php', ['create' => true]);
    }


    #[NoReturn] #[Post('/Dashboard/Delete/Moderator')]
    public function delete(): void
    {
        $id = htmlspecialchars($_POST['id']) ?? null;
        $password= htmlspecialchars($_POST['password']);

        if ($this->model->manager()['password'] !== $password){
            exit("Password");
        }

        if (! $this->deleteProfileImage($id)){
            exit('Profile');
        };

        if (! $this->model->delete($id)){
            exit("Failed");
        }

        exit("Passed");

    }


    public function deleteProfileImage(int|string $id): bool
    {
        $username = $this->model->moderator($id)['username'];

        $img1 = 'images/Profiles/Moderators/'.$username.'.png';
        $img2 = 'images/Profiles/Moderators/'.$username.'.jpg';
        $img3 = 'images/Profiles/Moderators/'.$username.'.jpeg';

        if (file_exists($img1)){
            unlink($img1);
            return true;
        }
        if (file_exists($img2)){
            unlink($img2);
            return true;
        }
        if (file_exists($img3)){
            unlink($img3);
            return true;
        }

        return true;
    }

    #[Get('/Dashboard/Moderator/Logout')]
    public function logout(): void
    {
        if (! $this->session->checkModeratorsSession()){
            header('Location: /Dashboard/Login/Moderator');
        }

        if($this->session->deleteModeratorSession()){
            header('Location: /Dashboard/Login/Moderator');
        }

        header('Location: /Dashboard/Moderator');
    }



    #[Get('/Dashboard/Moderator/Personal')]
    public function personal(): View
    {
        if (! $this->session->checkModeratorsSession()){
            header('Location: /Dashboard/Login/Moderator');
        }

        $username = $_SESSION['moderator'] ?? null;
        $data = $this->model->moderator($username);

        if (! $data){
            header('Location: /Dashboard/Login/Moderator');
        }

        return View::make('/Manage/moderators-personal', 'php', ['data' => $data]);
    }

    #[Post('/Dashboard/Moderator/Personal')]
    public function personalHandle(): View
    {
        if (! $this->session->checkModeratorsSession()){
            header('Location: /Dashboard/Login/Moderator');
        }

        $username = $_SESSION['moderator'] ?? null;
        $data = $this->model->moderator($username);

        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if (! $this->validator->patterner($email, '@')){
            return View::make('/Manage/moderators-personal', 'php', ['data' => $data, 'email' => true]);
        }

        if (! $this->validator->lengthy($phone, 10, 30)){
            return View::make('/Manage/moderators-personal', 'php', ['data' => $data, 'phone' => true]);
        }

        return $this->uploadProfile(['email' => $email, 'phone' => $phone]);
    }


    public function uploadProfile(array $demo): View
    {
        $username = $_SESSION['moderator'] ?? null;
        $data = $this->model->moderator($username);

        $name = $_FILES['image']['name'];
        $type = explode('.', $name)[1] ?? 'jpg';
        $size = $_FILES['image']['size'];
        $error = $_FILES['image']['error'];
        $temp = $_FILES['image']['tmp_name'];


        if (! $this->validator->arrayChecker($type, $this->eligibleTypes)){
            return View::make('/Manage/moderators-personal', 'php', ['type' => true, 'data' => $data]);
        }

        if (! $this->validator->sizeChecker(($size / 1024 / 1024), $_ENV['IMAGE_SIZE'])){
            return View::make('/Manage/moderators-personal', 'php', ['size' => true, 'data' => $data]);
        }


        if ($error !== 0){
            return View::make('/Manage/moderators-personal', 'php', ['error' => true, 'data' => $data]);
        }

        $uploadDir = 'images/Profiles/Moderators';
        $name = $username.'.'.$type;

        if (! move_uploaded_file($temp, $uploadDir.'/'.$name)){
            return View::make('/Manage/moderators-personal', 'php', ['upload' => true, 'data' => $data]);
        }

        if (! $this->model->addDemo($name, $demo['email'], $demo['phone'], $username)){
            return View::make('/Manage/moderators-personal', 'php', ['demo' => true, 'data' => $data]);
        }



        return View::make('/Manage/moderators-personal', 'php', ['data' => $data, 'done' => true]);
    }


    #[Get("/Dashboard/Moderator/Stats/Mine")]
    public function stats(): View
    {
        if (! $this->session->checkModeratorsSession()){
            header('Location: /Dashboard/Login/Author');
        }

        $username = $_SESSION['moderator'] ?? null;

        $startDate = (new \DateTime("first day of this month"))->format("Y-m-d");
        $endDate = (new \DateTime("last day of this month"))->format("Y-m-d");

        $data = $this->stats->moderatorsStats(id: $username, start: $startDate, end: $endDate);
        $data['username'] = $username;
        $data['start'] = str_replace("-", "/", $startDate);
        $data['end'] = str_replace("-", "/", $endDate);

        return View::make("/stats/moderator-mine", 'php',
            [
            'data' => $data ?? []
        ]);
    }

}