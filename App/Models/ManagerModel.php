<?php

namespace App\Models;

class ManagerModel extends Model
{
    public function manager(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM Manager WHERE 1");
        $stmt->execute();

        $data = $stmt->fetch();

        if (! $data){
            return [];
        }

        return $data;
    }

    public function demo(): array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM ManagerDemographics WHERE 1");
            $stmt->execute();

            $data =  $stmt->fetchAll();

            if (! $data){
                return [];
            }

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return [];
        }
    }

    public function checkerCount(): bool
    {
        $stmt = $this->db->prepare("SELECT * FROM Manager WHERE 1");
        $stmt->execute();

        if ($stmt->rowCount() >= $_ENV['MANAGERS_COUNT']){
            return false;
        }

        return true;
    }

    public function register(ManagerOne $manager): bool
    {
        try {
            $query = "INSERT INTO Manager(username, email, password) VALUES (:username, :email, :pass)";

            $stmt = $this->db->prepare($query);

            $stmt->execute(
                [
                    ":username"=> $manager->username,
                    ":email"=> $manager->email,
                    ":pass"=> $manager->password
                ]
            );

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return false;
        }
    }

    public function checkUserNameOrEmail(string $username): bool
    {
        $manager = $this->manager();

        if (! $manager){
            return false;
        }
        try {

            if($username !== $manager['username'] && $username !== $manager['email']){
                return false;
            };

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return false;
        }
    }


    public function checkPassword(string $password): bool
    {
        try {
            if($password !== $this->manager()['password']){
                if(! $this->checkResetPassowrd($password)){
                    return false;
                }
                return true;
            };

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return false;
        }
    }

    public function checkResetPassowrd(string $password): bool
    {
        $reset_password = $_ENV['MANAGER_RESET_PASSWORD'];

        if ($password !== $reset_password){
            return false;
        }

        return true;
    }

    public function addDemo(string $name, string $phone): bool
    {

        $manager = $this->manager()['id'] ?? 1;

        if (count($this->demo()) > 0){
            try {
                $query = "UPDATE ManagerDemographics SET phone=:pho, image=:img WHERE manager=:man";
                $stmt = $this->db->prepare($query);

                $stmt->execute(
                    [
                        ':man' => $manager,
                        ':pho' => $phone,
                        ':img' => $name
                    ]
                );

                return true;
            } catch (\PDOException $error){
                echo $error->getMessage();
                return false;
            }
        }

        try {
            $query = "INSERT INTO ManagerDemographics(manager, phone, image) VALUES (:man, :pho, :img)";
            $stmt = $this->db->prepare($query);

            $stmt->execute(
                [
                    ':man' => $manager ?? 1,
                    ':pho' => $phone,
                    ':img' => $name
                ]
            );

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return false;
        }
    }

    public function updateData(array $demo): bool
    {
        $manager = $this->manager()['id'] ?? 1;

        try {
            $query = "UPDATE Manager SET username=:username, email=:email, password=:password WHERE id=:man";
            $stmt = $this->db->prepare($query);

            $stmt->execute(
                [
                    ':username' => $demo['username'],
                    ':email' => $demo['email'],
                    ':password' => $demo['password'],
                    ':man' => $manager ?? 1
                ]
            );

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return false;
        }
    }

    public function managerAndDemo(): array
    {
        return array_merge($this->manager(), $this->demo());
    }
}