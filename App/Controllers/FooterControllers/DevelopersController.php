<?php

namespace App\Controllers\FooterControllers;

use App\Attributes\Get;
use App\View;

class DevelopersController
{
    #[Get("/Developers")]
    public function index(): View
    {
        return View::make("/footer/developers", "php", []);
    }
}