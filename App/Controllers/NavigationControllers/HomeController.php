<?php

    namespace App\Controllers\NavigationControllers;

    use App\Attributes\Get;
    use App\Attributes\Post;
    use App\Attributes\Route;
    use App\Models\HomeModel;
    use App\View;

    class HomeController{

    private string $address = "Home";
        public function __construct(
            protected HomeModel $model
        )
        {
        }

        #[Get('/')]
        #[Route('/home')]
        public function index(): View
        {
            $data = $this->model->today(3, 4);
            $top = $this->model->topStories(3);

            if (count($data) < 3){
                $data = $this->model->fetchPreviously(3, 4);
            }

            if (count($top) < 3){
                $top = $this->model->fetchPreviously(0, 3);
            }

            $mobileOne = $this->model->topStories(1);
            if (count($mobileOne) < 1){
                $mobileOne = $this->model->fetchPreviously(0, 1);
            }

            $mobileCenterThree = $this->model->today(1, 3);
            if (count($mobileCenterThree) < 3){
                $mobileCenterThree = $this->model->fetchPreviously(1, 3);
            }


            $mobileBottomThree = $this->model->today(3, 3);
            if (count($mobileBottomThree) < 3){
                $mobileBottomThree = $this->model->fetchPreviously(3, 3);
            }

            return View::make("index", "php", [
                'data' => $data,
                'top' => $top,
                'one' => $mobileOne,
                'center' => $mobileCenterThree,
                'bottom' => $mobileBottomThree,
                'address' => $this->address
            ]);
        }

        #[Post("/")]
        #[Route("/", "post")]
        public function search(): View
        {
            $pattern = htmlentities($_POST['home_search'] ?? null);

            $data = $this->model->today(3, 4);

            $mobileCenterThree = $this->model->today(1, 3);

            if (count($mobileCenterThree) < 3){
                $mobileCenterThree = $this->model->fetchPreviously(1, 3);
            }

            if ($pattern){
                $data = $this->model->search($pattern);
                $mobileCenterThree = array_slice($data, 0, 3);
            }

            $top = $this->model->topStories(3);

            if (count($top) < 3){
                $top = $this->model->fetchPreviously(0, 3);
            }

            $mobileOne = $this->model->topStories(1);
            if (count($mobileOne) < 1){
                $mobileOne = $this->model->fetchPreviously(0, 1);
            }

            $mobileBottomThree = $this->model->today(3, 3);
            if (count($mobileBottomThree) < 3){
                $mobileBottomThree = $this->model->fetchPreviously(3, 3);
            }


            return View::make("index", "php", [
                'data' => $data,
                'top' => $top,
                'one' => $mobileOne,
                'center' => $mobileCenterThree,
                'bottom' => $mobileBottomThree,
                'address' => $this->address
            ]);
        }
    }