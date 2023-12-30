<?php

    namespace App;
    use App\Exceptions\ViewNotFoundException;
    use App\Models\ArticlesModel;


    class View
    {
        public function __construct(
            private string $view,
            private string $template,
            private array $params
        )
        {

        }
        public function render(): string
        {
            $viewPath = VIEW_PATH."/".$this->view.".".$this->template;

            if(! file_exists($viewPath)){
                throw new ViewNotFoundException();
            }

            ob_start();
            
            require_once $viewPath;

            return (string) ob_get_clean();
        }

        public static function make(string $view, string $template, array $arguments): static
        {
            return new static($view, $template, $arguments);
        }

        // converting the make method strictly to a string in order to render and cast it to a string
        public function __toString(): string
        {
            return $this->render();
        }

        public function __get(string $name)
        {
            return $this->params[$name] ?? null;
        }

        public function resolveDate(string $date): string
        {
            return implode("/", array_reverse(explode("-", (explode(" ", $date)[0]))));
        }


        public function returnUsernameOrEmail(string $usernameOrEmail): array
        {
            $model = new ArticlesModel();

            $data =  $model->usernameOrEmail($usernameOrEmail) ?? [];

            $username =  $data['username'] ?? "Manager";
            $email =  $data['email'];
            $phone =  $data['phone'] ?? $_ENV['WEBSITE_PHONE'];
            $twitter =  $data['twitter'] ?? $_ENV['WEBSITE_NAME'];

            if ($email == "No email"){
                $email =  $_ENV['WEBSITE_NAME'];
            }

            if ($phone == "No phone"){
                $phone =  $_ENV['WEBSITE_PHONE'];
            }

            return [
                'username' => $username, 
                'email' => $email, 
                'phone' => $phone,
                'twitter' => $twitter,
            ];
        }


        public function resolvePosition(string $usernameOrEmail): string
        {
            $model = new ArticlesModel();

            if ($model->checkIfModerator($usernameOrEmail)){
                return "Moderators";
            }

            if ($model->checkIfAuthor($usernameOrEmail)){
                return "Authors";
            }

            return "Manager";
        }

    }