<?php

namespace App\Controllers\NavigationControllers;

use App\Attributes\Get;
use App\Controllers\UIController;
use App\Models\NewModel;
use App\View;

class SportsController extends UIController
{

    private string $address = "Sports";
    public function __construct(
        protected NewModel $model
    )
    {
    }

    #[Get('/Sports')]
    public function index(): View
    {
        $tag = 'Sports';

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