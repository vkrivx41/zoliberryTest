<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\View;

class CreateNewController
{
    #[Get('/Dashboard/create')]
    public function index(): View
    {
        return View::make('/create/index', 'php', []);
    }
}