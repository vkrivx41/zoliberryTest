<?php

namespace App\Controllers\ManagementControllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Controllers\SessionController;
use App\Models\ArticlesModel;
use App\Models\ManagerModel;
use App\View;
use JetBrains\PhpStorm\NoReturn;

class ArticlesManagementController
{

    public function __construct(
        protected SessionController $session,
        protected ArticlesModel $model,
        protected ManagerModel $managerModel
    )
    {
    }

    #[Get('/Dashboard/Manage/Articles')]
    public function articles(): View
    {
        if (! $this->session->checkManagerSession()){
            header('Location: /Dashboard/Login/manager');
        }

        if (isset($_GET['search'])){
            return $this->search();
        }


        if (isset($_GET['limit'])){
            $limit = (int) $_GET['limit'] ?? $_ENV['LIMIT'];
        } else{
            $limit = $_ENV['LIMIT'];
        }

        if ($limit === 0) $limit = $_ENV['LIMIT'];

        $data = $this->model->all($limit);

        if (! $data){
            return View::make("Manage/articles", 'php', ['error' => true, 'data' => []]);
        }

        return View::make("Manage/articles", 'php',
            [
                'data' => $data,
                'limit' => $limit
            ]
        );
    }


    #[NoReturn] #[Post('/Dashboard/Manage/Articles/Delete')]
    public function deleteArticle(): void
    {
        $id = htmlspecialchars($_POST['id'] ?? null) ?? null;
        $password= htmlspecialchars($_POST['password']) ?? null;

        if ( $this->managerModel->manager()['password'] !== $password){
            exit("Password");
        }

        if (! $this->deleteImageOne($id)){
            exit('images');
        };

        if (! $this->deleteImage($id, 'two_image')){
            exit('images');
        };

        if (! $this->deleteImage($id, 'three_image')){
            exit('images');
        };

        if (! $this->deleteImage($id, 'four_image')){
            exit('images');
        };

        if (! $this->deleteImage($id, 'five_image')){
            exit('images');
        };

        if (! $this->model->delete($id)){
            exit("Failed");
        }


        exit("Passed");
    }

    private function deleteImageOne(int|string $id): bool
    {
        $data = $this->model->images($id);

        $imageDirectory = "images/Articles/".$data['tag'];
        $img1 = $imageDirectory."/".$data['one_image'];

        if (file_exists($img1)){
            unlink($img1);
            return true;
        }

        return true;
    }

    private function deleteImage(int|string $id, string $name): bool
    {
        $data = $this->model->images($id);

        $imageDirectory = "images/Articles/".$data['tag'];
        $image = $data[$name];

        if ($image){
            $img1 = $imageDirectory."/".$image;
            if (file_exists($img1)){
                unlink($img1);
                return true;
            }
            return true;
        }

        return true;
    }


    public function search(): View
    {
        $pattern = htmlspecialchars($_GET['search']);

        $data = $this->model->search($pattern);

        return View::make("Manage/articles", 'php', ['data' => $data]);
    }
}