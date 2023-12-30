<?php

namespace App\Controllers\NavigationControllers;

use App\Attributes\Get;
use App\Controllers\UIController;
use App\Models\NewModel;
use App\View;

class LifestyleController extends UIController
{

    private string $address = "Lifestyle";
    public function __construct(
        protected NewModel $model
    )
    {
    }

    #[Get('/Lifestyle')]
    public function index(): View
    {
        $tag = 'Lifestyle';

        $renderable = $this->render($tag);

        return View::make($tag."/index", "php", [
            'tag' => $tag,
            'data' => $renderable['data']?? [],
            'top' => $renderable['top'] ?? [],
            'one' => $renderable['mobileOne'] ?? [],
            'center' => $renderable['mobileCenterThree'] ?? [],
            'bottom' => $renderable['mobileBottomThree'] ?? [], 
            'address' => $this->address
        ]);
    }
}