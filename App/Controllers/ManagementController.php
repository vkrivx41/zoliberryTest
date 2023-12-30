<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Config;
use App\Models\ArticlesModel;
use App\Models\AuthorsModel;
use App\Models\ManagerModel;
use App\Models\ModeratorsModel;
use App\Validators\ParentValidator;
use App\View;

class ManagementController extends RegistrationController
{

    private Config $config;
    private array $consignment = [];
    private array $images = [];

    private string $uploadDirectory = 'images/Articles';

    public function __construct(
        protected SessionController $session,
        protected ParentValidator $validator,
        protected ModeratorsModel $moderatorsModel,
        protected AuthorsModel $authorsModels,
        protected ManagerModel $managerModel,
        protected ArticlesModel $articlesModel
    )
    {
        $this->config = new Config($_ENV);
    }



    private function resolveUsername(): string
    {
        $server = $_SERVER['REQUEST_URI'];

        if ($server === "/Dashboard/Moderator"){
            $username = $_SESSION['moderator'];
            $data = $this->moderatorsModel->moderator($username);

            if (! $data){
                header('Location: /Dashboard/Login/Moderator');
            }
            return $username;
        }

        if ($server === "/Dashboard/Author"){
            $username = $_SESSION['author'];
            $data = $this->authorsModels->author($username);

            if (! $data){
                header('Location: /Dashboard/Login/Author');
            }
            return $username;
        }

        $username = $_SESSION['manager'];
        $data = $this->managerModel->manager();

        if (! $data){
            header('Location: /Dashboard/Login/manager');
        }
        return $username;
    }


    public function UriResolver(string $error = ''): view
    {

        $server = $_SERVER['REQUEST_URI'];

        $data = $this->managerModel->manager();


        if ($server === "/Dashboard/create" || $server === "/Dashboard"){
            if (! $data){
                header('Location: /Dashboard/Login/manager');
            }

            return View::make("/create/index", 'php', ['with_error' => true, $error => true, 'data' => $data]);
        }

        if ($server === "/Dashboard/Moderator"){
            $username = $_SESSION['moderator'];
            $data = $this->moderatorsModel->moderator($username);

            if (! $data){
                header('Location: /Dashboard/Login/Moderator');
            }
            return View::make("/Dashboard/Moderators/index", 'php', ['with_error' => true, $error => true, 'data' => $data]);
        }

        if ($server === "/Dashboard/Author"){
            $username = $_SESSION['author'];
            $data = $this->authorsModels->author($username);

            if (! $data){
                header('Location: /Dashboard/Login/Author');
            }

            return View::make("/Dashboard/Authors/index", 'php', ['with_error' => true, $error => true, 'data' => $data]);
        }

        return View::make("/create/index", 'php', ['with_error' => true, 'data' => $data]);
    }

    #[Post('/Dashboard/Moderator')]
    #[Post('/Dashboard/create')]
    #[Post('/Dashboard/Author')]
    #[Post('/Dashboard')]
    public function handleArticle(): View
    {
        $this->session->check();
        $username = $this->resolveUsername();

        $category = htmlspecialchars($_POST['category']);
        $title = htmlspecialchars($_POST['title']);
        $paragraph_one = htmlspecialchars($_POST['paragraph_one_text']);
        $paragraph_two = htmlspecialchars($_POST['paragraph_two_text']);
        $paragraph_three = htmlspecialchars($_POST['paragraph_three_text']);
        $paragraph_four = htmlspecialchars($_POST['paragraph_four_text']);
        $paragraph_five = htmlspecialchars($_POST['paragraph_five_text']);

        $this->consignment = [
            'category' => $category,
            'title' => $title,
            'paragraph_one' => $paragraph_one,
            'paragraph_two' => $paragraph_two,
            'paragraph_three' => $paragraph_three,
            'paragraph_four' => $paragraph_four,
            'paragraph_five' => $paragraph_five,
            'author' => $username
        ];

        if (! $this->articlesModel->checkLimit($category)){
            return $this->UriResolver('limit');
        }

        if (! $this->validator->lengthy($category, 1)){
            return $this->UriResolver('category');
        }

        if (! $this->validator->lengthy($title, 1, $this->config->article['title'] ?? 200)){
            return $this->UriResolver('title');
        }

        if (! $this->validator->lengthy($paragraph_one, 1, $this->config->article['para'])){
            return $this->UriResolver('text');
        }

        return $this->textResolver($this->consignment);

    }

    private function textResolver(array $consignment): View
    {

        if (strlen($consignment['paragraph_two']) > 1){

            if (! $this->validator->lengthy($consignment['paragraph_two'], 1, $_ENV['PARA_COUNT'])){
                return $this->UriResolver('two_text');
            }
        }


        if (strlen($consignment['paragraph_three']) > 1){
            if (! $this->validator->lengthy($consignment['paragraph_three'], 1, $_ENV['PARA_COUNT'])){
                return $this->UriResolver('three_text');
            }
        }

        if (strlen($consignment['paragraph_four']) > 1){
            if (! $this->validator->lengthy($consignment['paragraph_four'], 1, $_ENV['PARA_COUNT'])){
                return $this->UriResolver('four_text');
            }
        }


        if (strlen($consignment['paragraph_five']) > 1){
            if (! $this->validator->lengthy($consignment['paragraph_five'], 1, $_ENV['PARA_COUNT'])){
                return $this->UriResolver('five_text');
            }
        }


        return $this->imagesResolver();

    }

    public function imagesResolver(): View
    {
        $imageOne = $_FILES['image_one'] ?? [];

        $name = $imageOne['name'];
        $type = explode('.', $name)[1] ?? 'jpg';
        $size = $imageOne['size'];
        $error = $imageOne['error'];
        $temp = $imageOne['tmp_name'];

        if (empty($imageOne['name'])){
            return $this->UriResolver('image_one');
        }

        if (! $this->validator->arrayChecker($type, $this->eligibleTypes)){
            return $this->UriResolver('type');
        }


        if (! $this->validator->sizeChecker($size / 1024 / 1024, $_ENV['IMAGE_SIZE'])){
            return $this->UriResolver('size');
        }

        if ($error !== 0){
            return $this->UriResolver('error');
        }


        $this->uploadDirectory = match ($this->consignment['category']){
            'News' => 'images/Articles/News',
            'Sports' => 'images/Articles/Sports',
            'Music' => 'images/Articles/Music',
            default => 'images/Articles/Lifestyle',
        };

        $name = 'article'.$this->articlesModel->randomIdCreator().'.'.$type;

        if (! move_uploaded_file($temp, $this->uploadDirectory.'/'.$name)){
            return $this->UriResolver('image_up');
        }


        $this->images[] = ['image_one' => $name];

        return $this->otherImagesResolver();
    }

    private function otherImagesResolver(): View
    {
        if(! empty($_FILES['image_two']['name'])){
            $name = $_FILES['image_two']['name'];
            $type = explode('.', $name)[1] ?? 'jpg';
            $name = 'article'.$this->articlesModel->randomIdCreator().'.'.$type;

            $this->images[] = ['image_two' => $name];

             if (! $this->resolveImage($_FILES['image_two'], $name, $type)){
                 return $this->UriResolver('upload');
             }
        }

        if(! empty($_FILES['image_three']['name'])){

            $name = $_FILES['image_three']['name'];
            $type = explode('.', $name)[1] ?? 'jpg';
            $name = 'article'.$this->articlesModel->randomIdCreator().'.'.$type;

            $this->images[] = ['image_three' => $name];
            if (! $this->resolveImage($_FILES['image_three'], $name, $type)){
                return $this->UriResolver('upload');
            }
        }

        if(! empty($_FILES['image_four']['name'])){

            $name = $_FILES['image_four']['name'];
            $type = explode('.', $name)[1] ?? 'jpg';
            $name = 'article'.$this->articlesModel->randomIdCreator().'.'.$type;

            $this->images[] = ['image_four' => $name];

            if (! $this->resolveImage($_FILES['image_four'], $name, $type)){
                return $this->UriResolver('upload');
            }
        }

        if(! empty($_FILES['image_five']['name'])){

            $name = $_FILES['image_five']['name'];
            $type = explode('.', $name)[1] ?? 'jpg';
            $name = 'article'.$this->articlesModel->randomIdCreator().'.'.$type;

            $this->images[] = ['image_five' => $name];

            if (! $this->resolveImage($_FILES['image_five'], $name, $type)){
                return $this->UriResolver('upload');
            }
        }


        return $this->uploadArticle();

    }

    private function resolveImage(array $image, string $name, string $type = "jpg"): bool
    {
        $size = $image['size'];
        $error = $image['error'];
        $temp = $image['tmp_name'];

        if (! $this->validator->arrayChecker($type, $this->eligibleTypes)){
            return false;
        }

        if (! $this->validator->sizeChecker($size / 1024 / 1024, $_ENV['IMAGE_SIZE'])){
            return false;
        }

        if ($error !== 0){
            return false;
        }

        if (! move_uploaded_file($temp, $this->uploadDirectory.'/'.$name)){
            return false;
        }

        return true;
    }

    private function uploadArticle(): View
    {
        if (! $this->articlesModel->create($this->consignment)){

            return $this->UriResolver('upload');
        }

        if (! $this->articlesModel->uploadImages($this->images)){

            return $this->UriResolver('upload');
        }


        return $this->UriResolver('done');
    }

}