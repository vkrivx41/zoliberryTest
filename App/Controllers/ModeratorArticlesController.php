<?php

    namespace App\Controllers;

    use App\Attributes\Get;
    use App\Models\ArticlesModel;
    use App\View;

    class ModeratorArticlesController {
        public function __construct(
            private ArticlesModel $model,
            private SessionController $session
        ){

        }

        #[Get('/Dashboard/Moderator/Articles')]
        public function manageArticles(): View 
        {
            if (! $this->session->checkModeratorsSession()){
                header('Location: /Dashboard/Moderator');
            }
    
            if (isset($_GET['search'])){
                return $this->search();
            }
    
    
            if (isset($_GET['limit'])){
                $limit = (int) $_GET['limit'] ?? $_ENV['LIMIT'];
            } else{
                $limit = $_ENV['LIMIT'];
            }
    
            if ($limit === 0) $limit = $_ENV['LIMIT'];
    
            $data = $this->model->all($limit);
    
            if (! $data){
                return View::make("/Templates/Dashboard/moderator-articles", 'php', ['error' => true, 'data' => []]);
            }
    
            return View::make("/Templates/Dashboard/moderator-articles", 'php',
                [
                    'data' => $data,
                    'limit' => $limit
                ]
            );
        }

        public function search(): View
        {
            $pattern = htmlspecialchars($_GET['search']);

            $data = $this->model->search($pattern);

            return View::make("/Templates/Dashboard/moderator-articles", 'php', ['data' => $data]);
        }

    }