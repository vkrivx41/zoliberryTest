<?php

    namespace App\Controllers\UsersControllers;

    use App\Attributes\Get;
    use App\Attributes\Post;
    use App\Models\UserModel;
    use JetBrains\PhpStorm\NoReturn;

    class ThemeController
    {

        public function __construct(
            protected UserModel $userModel
        )
        {
        }

        #[NoReturn]
        #[Post("/User/Theme")]
        public function saveTheme(): void
        {
            $theme = htmlentities($_POST['theme'] ?? "");

            if ($theme === ""){
                exit("empty");
            }

            $id = $_COOKIE['user_id'] ?? null;

            if(! $this->userModel->setTheme($theme, $id)){
                exit("error");
            }

            exit("white");

            exit($this->getTheme());
        }

        #[NoReturn]
        #[Get("/User/Theme/Get")]
        public function getTheme(): void
        {
            $id = (int) $_COOKIE['user_id'] ?? null;

            if (! $id){
                exit("white");
            }

            if (! $theme = $this->userModel->getTheme($id)){
                exit("get_error");
            }

            exit($theme);
        }
    }
