<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Models\ArticlesModel;
use App\View;

class ArticleController
{
    public function __construct(
        protected ArticlesModel $model
    )
    {
    }

    public function index(): View
    {
        $id = $_GET['id'] ?? null;
        $title = $_GET['title'] ?? null;

        if (! $id and ! $title){
            header("Location: /");
        }


        $popular = $this->model->popular();

        $data = $this->model->article($id);

        return View::make("/link/index", 'php',
            [
                'data' => $data,
                'id' => $id,
                'title' => $title,
                'popular' => $popular,
            ]
        );
    }
}