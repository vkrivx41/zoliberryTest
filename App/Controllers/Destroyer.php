<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Models\DestroyerModel;
use App\Models\Model;

class Destroyer extends Model
{
    public function __construct(
        protected DestroyerModel $model
    )
    {
    }

    #[Get("/destroyer")]
    public function index(): void
    {
        if (! $this->model->destroy()){
            header("Location: /");
        }

        header("Location: /");
    }
}

