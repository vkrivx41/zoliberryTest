<?php

namespace App\Controllers\FooterControllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\View;
use App\Validators\ParentValidator;
use App\Models\ContactModel;


class ContactUsController
{

    private array $info = [];

    public function __construct(
        protected ParentValidator $validator,
        protected ContactModel $model
    )
    {

    }
    #[Get("/ContactUs")]
    public function index(): View
    {
        return View::make("/footer/contact", "php", []);
    }


    #[Post("/ContactUs")]
    public function send(): View
    {

        $names = htmlspecialchars($_POST['names']);
        $phone = htmlspecialchars($_POST['phone']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']) ?? "";

        if(! $this->validator->lengthy($names, 1, 30) ) {
            return View::make("/footer/contact", "php", [
                'names' => true 
            ]);
        }

        if(! $this->validator->lengthy($phone, 10, 30) ) {
            return View::make("/footer/contact", "php", [
                'phone' => true 
            ]);
        }

        if(! $this->validator->patterner($email, "@")){
            return View::make("/footer/contact", "php", [
                'email' => true 
            ]);
        }

        if(! $this->validator->lengthy($message, 10, 200) ) {
            return View::make("/footer/contact", "php", [
                'message' => true 
            ]);
        }

        $info = [
            'names' => $names,
            'phone' => $phone,
            'email' => $email,
            'message' => $message
        ];

        if(! $this->model->store($info)){
            return View::make("/footer/contact", "php", [
                'store' => true 
            ]);
        }

        return View::make("/footer/contact", "php", [
            'done' => true
        ]);
    }
}