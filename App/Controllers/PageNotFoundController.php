<?php

    declare(strict_types=1);

    namespace App\Controllers;


    use App\View;

    class PageNotFoundController
    {
        public function index(): View
        {
            $uri = strtolower($_SERVER['REQUEST_URI']);
            $message = "Hello, user the page you are looking for is not found.";

            if (str_contains($uri, "/dashboard/moderator") || str_contains($uri, "/dashboard/login/moderator")){
                $message = "Hello, moderator the page you are looking for is not found.";
                return View::make("/404/moderator", 'php', [
                    'message' => $message
                ]);
            } elseif (str_contains($uri, "/dashboard/author") || str_contains($uri, "/dashboard/login/author")){
                $message = "Hello, author the page you are looking for is not found.";
                return View::make("/404/author", 'php', [
                    'message' => $message
                ]);
            }
            elseif (str_contains($uri, "/dashboard") || str_contains($uri, "/Dashboard/Login/manager") || str_contains($uri, "/dashboard/register")){
                $message = "Hello, Manager the page you are looking for is not found.";
                return View::make("/404/manager", 'php', [
                    'message' => $message
                ]);
            }

            return View::make("/404/user", 'php', [
                'message' => $message
            ]);

        }
    }
