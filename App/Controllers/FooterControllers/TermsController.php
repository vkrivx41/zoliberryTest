<?php

namespace App\Controllers\FooterControllers;

use App\Attributes\Get;
use App\View;

class TermsController
{
    #[Get("/TermsAndConditions")]
    #[Get("/Terms")]
    public function index(): View
    {
        return View::make("/footer/terms", "php", []);
    }
}