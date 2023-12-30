<?php

namespace App\Controllers\ManagementControllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Models\ArticlesModel;
use App\View;

class EditArticleController
{
    public function __construct(
        protected ArticlesModel $articlesModel,
        protected TextManagementController $textController,
        protected ImageManagementController $imageController,
    ){
    }

    #[Get("/Dashboard/Moderator/Articles/Edit")]
    #[Get("/Dashboard/Manage/Articles/Edit")]
    public function index(): View
    {
        $sender = "Moderator";
        $id = htmlspecialchars($_GET['id']);

        $article = $this->articlesModel->article($id, true);

        if(str_contains($_SERVER['REQUEST_URI'], "Manage")){
            $sender = "Manager";
        }

        if(! $id or ! $this->articlesModel->check_if_article_exist($id) or ! $article){
            if(str_contains($_SERVER['REQUEST_URI'], "Manage")){
                header("Location: /Dashboard");
            } else{
                header("Location: /Dashboard/Moderator");
            }
        }

        return View::make("/edit/index", "php", [
            'sender' => $sender,
            'article' => $article
        ]);
    }

    

    #[Post("/Dashboard/Moderator/Articles/Edit")]
    #[Post("/Dashboard/Manage/Articles/Edit")]
    public function edit_and_upate(): View
    {
        $id = htmlspecialchars($_GET['id'] ?? null);

        $artcile = $this->articlesModel->article($id, true);
        $editor = $this->editor_determiner($this->textController->uri);

        $param = $this->param_creator('done', $editor, $artcile);


        $request_error =  $this->textController->process_request($_POST);

        //  check if the error is unknown in order to sender an unexpected error

        if($request_error == "unknown"){
            $error = "Expected error occurred try again later";

            $param = $this->param_creator($error, $editor, $artcile);
            return View::make("/edit/index", 'php', $param);
        }

        // check for the returned error to return it to the view

        if($request_error !== ""){
            $error = $this->textController->get_error($request_error);

            $param = $this->param_creator($error, $editor, $artcile);
            return View::make("/edit/index", 'php', $param);
        }


        // get the texts and update them to the database

        $texts = $this->textController->get_texts();


        if(! $this->articlesModel->update_texts($texts, $id)){
            $error = "upload";

            $error = $this->textController->get_error($error);

            $param = $this->param_creator($error, $editor, $artcile);
            return View::make("/edit/index", 'php', $param);
        }
        

        /** 
         * In case there is no errors in texts, validate images
         */

        $image_error = $this->imageController->process_image($_FILES, $this->textController->get_category());

        if($image_error !== "" or strlen($image_error) > 0){
            $error = $this->imageController->get_error($image_error);
        
            $param = $this->param_creator($error, $editor, $artcile);
            return View::make("/edit/index", 'php', $param);
        }


         /** 
         * In case there is no errors in images, update the images in the database
         */

        $images = $this->imageController->get_images();

        if(! $this->articlesModel->uploadImages($images, $id)){
            $error = "upload";

            $error = $this->imageController->get_error($error);

            $param = $this->param_creator($error, $editor, $artcile);
            return View::make("/edit/index", 'php', $param);
        }


        return View::make("/edit/index", 'php', $param);
    }

    private function param_creator(string|null $error, string $editor, $artcile): array
    {
        return [
            'error' => $error,
            'article' => $artcile,
            'sender' => $editor
        ];
    }

    public function editor_determiner(string $uri): string
    {
        $editor = "Manager";

        if(str_contains($uri, "moderator")){
            $editor = "Moderator";
        }

        return $editor;
    }


    /**
     * checks for undefined names or properties
     *
     * @param string $name
     * @return string
     */
}