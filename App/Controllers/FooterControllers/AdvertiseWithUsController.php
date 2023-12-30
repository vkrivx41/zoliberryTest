<?php

namespace App\Controllers\FooterControllers;

use App\Attributes\Get;
use App\View;

class AdvertiseWithUsController
{
    #[Get("/Advertise")]
    #[Get("/AdvertiseWithUs")]
    public function index(): View
    {
        return View::make("/footer/advertise", "php", []);
    }
}