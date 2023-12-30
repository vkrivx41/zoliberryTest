<?php

namespace App\Controllers\NavigationControllers;

use App\Attributes\Get;
use App\Controllers\UIController;
use App\Models\NewModel;
use App\View;

class MusicController extends UIController
{

    private string $address = "Music";
    public function __construct(
        protected NewModel $model
    )
    {
    }

    #[Get('/Music')]
    public function index(): View
    {
        $tag = 'Music';
        $date = (new \DateTime('now'))->format('M-d-Y');
        $yes = (new \DateTime('yesterday'))->format('M-d-Y');

        $renderable = $this->render($tag);

        return View::make($tag."/index", "php", [
            'tag' => $tag,
            'date' => [$date, $yes],
            'data' => $renderable['data']?? [],
            'top' => $renderable['top'] ?? [],
            'one' => $renderable['mobileOne'] ?? [],
            'center' => $renderable['mobileCenterThree'] ?? [],
            'bottom' => $renderable['mobileBottomThree'] ?? [],
            'address' => $this->address ?? null
        ]);
    }
}