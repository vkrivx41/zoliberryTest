<?php

namespace App\Controllers\ManagementControllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Controllers\RegistrationController;
use App\Controllers\SessionController;
use App\Models\AuthorsModel;
use App\Models\Stats;
use App\Validators\ParentValidator;
use App\View;
use JetBrains\PhpStorm\NoReturn;

class AuthorsController extends RegistrationController
{
    protected static int $counter = 0;

    public function __construct(
        protected AuthorsModel $model,
        protected SessionController $session,
        protected ParentValidator $validator,
        protected Stats $authorsStats
    )
    {
    }

    #[Get('/Dashboard/Author')]
    public function author(): View
    {
        if (! $this->session->checkAuthorSession()){
            header('Location: /Dashboard/Login/Author');
        }

        $username = $_SESSION['author'] ?? null;
        $data = $this->model->author($username);

        if (! $data){
            header('Location: /Dashboard/Login/Author');
        }

        return View::make("/Dashboard/Authors/index", 'php', ['data' => $data]);
    }


    #[Get('/Dashboard/Manage/Authors')]
    public function manageAuthors(): View
    {
        if (! $this->session->checkManagerSession()){
            header('Location: /Dashboard/Login/manager');
        }

        $data = $this->model->all();

        return View::make("Manage/authors", 'php', ['data' => array_values($data)]);
    }

    #[Get('/Dashboard/Create/Author')]
    public function createAuthor(): View
    {
        return View::make('/create/Author/index', 'php', []);
    }


    #[Post('/Dashboard/Create/Author')]
    public function handleAuthor(): View
    {
        return $this->handler('/create/Author/index', $_POST);
    }


    #[NoReturn] #[Post('/Dashboard/Delete/Author')]
    public function delete(): void
    {

        $id = htmlspecialchars($_POST['id'] ?? null) ?? null;
        $password= htmlspecialchars($_POST['password']) ?? null;

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
        $username = $this->model->author($id)['username'];

        $img1 = 'images/Profiles/Authors/'.$username.'.png';
        $img2 = 'images/Profiles/Authors/'.$username.'.jpg';
        $img3 = 'images/Profiles/Authors/'.$username.'.jpeg';

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

    public function addToDatabase(array $data): View
    {
        if (! $this->model->checkName($data['username']))
        {
            return View::make('/create/Author/index', 'php', ['reName' => true]);
        }

        if (! $this->model->create($data)){
            return View::make('/create/Author/index', 'php', ['error' => true]);
        }

        return View::make('/create/Author/index', 'php', ['create' => true]);
    }


    #[Get('/Dashboard/Login/Author')]
    public function login(): View
    {
        return View::make('/login/author', 'php', []);
    }

    #[Post('/Dashboard/Login/Author')]
    public function loginHandler(): View
    {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if ($this->model->checkName($username)){
            return View::make('/login/author', 'php', ['name' => true]);
        }

        if (! $this->model->checkPassword($password, $username)){
            return View::make('/login/author', 'php', ['password' => true]);
        }

        if (! $this->session->author($username)){
            return View::make('/login/author', 'php', ['session' => true]);
        }

        return View::make('/login/pass.author', 'php', []);
    }



    #[Get('/Dashboard/Author/Logout')]
    public function logout(): void
    {
        if (! $this->session->checkAuthorSession()){
            header('Location: /Dashboard/Login/Author');
        }

        if($this->session->deleteAuthorSession()){
            header('Location: /Dashboard/Login/Author');
        }

        header('Location: /Dashboard/Author');
    }


    #[Get('/Dashboard/Author/Personal')]
    public function personal(): View
    {
        if (! $this->session->checkAuthorSession()){
            header('Location: /Dashboard/Login/Author');
        }

        $username = $_SESSION['author'] ?? null;
        $data = $this->model->author($username);

        if (! $data){
            header('Location: /Dashboard/Login/Author');
        }

        return View::make('/Manage/authors-personal', 'php', ['data' => $data]);
    }

    #[Post('/Dashboard/Author/Personal')]
    public function personalHandle(): View
    {
        if (! $this->session->checkAuthorSession()){
            header('Location: /Dashboard/Login/Author');
        }

        $username = $_SESSION['author'] ?? null;
        $data = $this->model->author($username);

        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if (! $this->validator->patterner($email, '@')){
            return View::make('/Manage/authors-personal', 'php', ['data' => $data, 'email' => true]);
        }

        if (! $this->validator->lengthy($phone, 10, 30)){
            return View::make('/Manage/authors-personal', 'php', ['data' => $data, 'phone' => true]);
        }

        return $this->uploadProfile(['email' => $email, 'phone' => $phone]);
    }

    public function uploadProfile(array $demo): View
    {
        $username = $_SESSION['author'] ?? null;
        $data = $this->model->author($username);

        $name = $_FILES['image']['name'];
        $type = explode('.', $name)[1] ?? 'jpg';
        $size = $_FILES['image']['size'];
        $error = $_FILES['image']['error'];
        $temp = $_FILES['image']['tmp_name'];


        if (! $this->validator->arrayChecker($type, $this->eligibleTypes)){
            return View::make('/Manage/authors-personal', 'php', ['type' => true, 'data' => $data]);
        }

        if (! $this->validator->sizeChecker(($size / 1024 / 1024), $_ENV['IMAGE_SIZE'])){
            return View::make('/Manage/authors-personal', 'php', ['size' => true, 'data' => $data]);
        }

        if ($error !== 0){
            return View::make('/Manage/authors-personal', 'php', ['error' => true, 'data' => $data]);
        }

        $uploadDir = 'images/Profiles/Authors';
        $name = $username.'.'.$type;

        if (! move_uploaded_file($temp, $uploadDir.'/'.$name)){
            return View::make('/Manage/authors-personal', 'php', ['upload' => true, 'data' => $data]);
        }

        if (! $this->model->addDemo($name, $demo['email'], $demo['phone'], $username)){
            return View::make('/Manage/authors-personal', 'php', ['demo' => true, 'data' => $data]);
        }



        return View::make('/Manage/authors-personal', 'php', ['data' => $data, 'done' => true]);
    }

    #[Get("/Dashboard/Author/Stats")]
    public function stats(): View
    {
        if (! $this->session->checkAuthorSession()){
            header('Location: /Dashboard/Login/Author');
        }

        $username = $_SESSION['author'] ?? null;


        $startDate = (new \DateTime("previous monday"))->format("Y-m-d");
        $endDate = (new \DateTime("next sunday"))->format("Y-m-d");

        $data = $this->authorsStats->authorStatus(id: $username, start: $startDate, end: $endDate);


        return View::make("stats/author", "php", [
            'data' => $data ?? [],
            'start' => $startDate ?? "",
            'end' => $endDate ?? "",
        ]);
    }

}