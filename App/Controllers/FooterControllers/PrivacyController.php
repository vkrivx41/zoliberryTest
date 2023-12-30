<?php

namespace App\Controllers\FooterControllers;

use App\Attributes\Get;
use App\View;

class PrivacyController
{
    #[Get("/PrivacyAndPolicy")]
    #[Get("/Privacy")]
    public function index(): View
    {
        return View::make("/footer/privacy", "php", []);
    }
}