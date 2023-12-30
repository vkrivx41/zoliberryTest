<?php

    namespace App\Controllers\ManagementControllers;

    use App\View;
    use App\Attributes\Get;
    use App\Attributes\Post;
    use App\Models\ContactModel;

    class MessagesController
    {
        public function __construct(
            protected ContactModel $model
        )
        {

        }

        #[Get("/Dashboard/Messages")]
        public function index(): View
        {
            $data = $this->model->all();

            return View::make("/Manage/messages", "php", [
                'data' => $data
            ]);
        }

        #[Get("/Dashboard/Moderator/Messages")]
        public function moderatorMessages(): View
        {
            $data = $this->model->all();

            return View::make("/messages/index", "php", [
                'data' => $data
            ]);
        }

        #[Post("/Dashboard/Messages")]
        public function delete()
        {

            $id = htmlspecialchars($_POST['id']);

            if(! $this->model->delete($id)){
                return "Failed";
            }

            return "Passed";
        }
    }