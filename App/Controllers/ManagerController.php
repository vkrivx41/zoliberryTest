<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Models\ManagerModel;
use App\View;

class ManagerController
{

    public function __construct(
        protected SessionController $session,
        protected ManagerModel $model

    )
    {
    }

    #[Get('/Dashboard/Manager')]
    #[Get('/Dashboard')]
    public function index(): View
    {
        if (! $this->session->checkManagerSession()){
            header('Location: ./Dashboard/Login/manager');
        }

        $data = $this->model->manager();

        if (! $data){
            header('Location: ./Dashboard/Login/manager');
        }

        return View::make('Dashboard/Manager/index', 'php', []);
    }

    #[Get('/Dashboard/Logout')]
    public function logout(): View
    {
        if ($this->session->checkManagerSession()){
            $this->session->deleteManagerSession();

            header('Location: /Dashboard/Login/manager');
        }

        return View::make('Dashboard/Manager/index', 'php', []);
    }
}