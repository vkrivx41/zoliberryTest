<?php

    namespace App\Controllers;
    use App\Attributes\{Get, Post};
    use App\Models\AuthorsModel;
    use App\View;

    class ModeratorAuthorsController extends RegistrationController
    {
        public function __construct(
            private AuthorsModel $model,
            private SessionController $session
        )
        {

        }

        #[Get("/Dashboard/Moderator/Authors")]
        public function manageAuthors(): View
       {
            if (! $this->session->checkModeratorsSession()){
                header('Location: /Dashboard/Moderator');
            }

            $data = $this->model->all();


            return View::make("/Templates/Dashboard/moderator-author", 'php', ['data' => array_values($data)]);
       }

       #[Get("/Dashboard/Moderator/Create/Author")]
       public function createAuthor(): View
       {
            $sender = "Moderator";

            return View::make('/create/Author/moderator', 'php', ['sender' => $sender]);
       }

       #[Post("/Dashboard/Moderator/Create/Author")]
       public function handleCreateAuthor(): View
       {
            return $this->handler("/create/Author/moderator", $_POST);
       }

       public function addToDatabase(array $data): View
        {
            if (! $this->model->checkName($data['username']))
            {
                return View::make("/create/Author/moderator", 'php', ['reName' => true]);
            }

            if (! $this->model->create($data)){
                return View::make("/create/Author/moderator", 'php', ['error' => true]);
            }

            return View::make("/create/Author/moderator", 'php', ['create' => true]);
        }
    }