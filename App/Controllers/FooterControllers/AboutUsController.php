<?php

namespace App\Controllers\FooterControllers;

use App\Attributes\Get;
use App\View;

class AboutUsController
{
    #[Get("/AboutUS")]
    public function index(): View
    {
        return View::make("/footer/about", "php", []);
    }
}