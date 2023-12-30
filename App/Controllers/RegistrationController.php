<?php

namespace App\Controllers;

use App\Validators\ManagerValidator;
use App\View;

class RegistrationController
{

    public array $eligibleTypes = ['png', 'jpg', 'jpeg'];

    public function handler(string $route, array $data): View
    {

        $validator = (new ManagerValidator());

        $username = htmlspecialchars($data['username'] ?? null);
        $password = htmlspecialchars($data['password'] ?? null);
        $rePassword = htmlspecialchars($data['re-password'] ?? null);
        $email = htmlspecialchars($data['email'] ?? null);
        $phone = htmlspecialchars($data['phone'] ?? null);
        $twitter = htmlspecialchars($data['twitter'] ?? null);

        $data = [
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'twitter' => $twitter
        ];
        

        if(! $validator->name($username)){
            return View::make($route, 'php', ['name' => true]);
        };

        if( strlen($twitter) < 2){
            return View::make($route, 'php', ['twitter' => true]);
        };
        

        if(! $validator->password($password)){
            return View::make($route, 'php', ['password' => true]);
        };

        if(! $validator->rePassword($password, $rePassword)){
            return View::make($route, 'php', ['rePassword' => true]);
        };

        if ($email){
            if(! $validator->email($email)){
                return View::make($route, 'php', ['email' => true]);
            };
        }

        if ($phone){
            if (! $validator->phone($phone)){
                return View::make($route, 'php', ['phone' => true]);
            }
        }

        return $this->addToDatabase($data);
    }
}