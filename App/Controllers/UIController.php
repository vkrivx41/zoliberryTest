<?php

namespace App\Controllers;

use App\Models\NewModel;

class UIController
{
    public function __construct(
        protected NewModel $model
    )
    {
    }

    public function  render(string $tag): array
    {
        $data = $this->model->today($tag, 3, 4);
        $top = $this->model->top($tag, 3);

        if (count($data) < 3){
            $data = $this->model->fetchPreviously($tag, 3, 4);
        }

        if (count($top) < 3){
            $top = $this->model->fetchPreviously($tag, 0, 3);
        }

        $mobileOne = $this->model->top($tag,1);
        if (count($mobileOne) < 1){
            $mobileOne = $this->model->fetchPreviously($tag, 0, 1);
        }

        $mobileCenterThree = $this->model->today($tag, 1, 3);
        if (count($mobileCenterThree) < 3){
            $mobileCenterThree = $this->model->fetchPreviously($tag,1, 3);
        }

        $mobileBottomThree = $this->model->today($tag, 3, 3);
        if (count($mobileBottomThree) < 3){
            $mobileBottomThree = $this->model->fetchPreviously($tag,3, 3);
        }

        return [
            'data' => $data,
            'top' => $top,
            'mobileOne' => $mobileOne,
            'mobileCenterThree' => $mobileCenterThree,
            'mobileBottomThree' => $mobileBottomThree,
        ];
    }


}