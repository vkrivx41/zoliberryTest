<?php

namespace App\Models;

class AuthorsModel extends Model
{
    public function check(): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Author");
            $stmt->execute();

            if ($stmt->rowCount() >= $_ENV['AUTHORS_COUNT']){
                return false;
            }
            return true;

        } catch(\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }

    public function checkName(string $name): bool
    {
        try {
            $query = "SELECT * FROM Author WHERE username=?";
            $stmt = $this->db->prepare($query);

            $stmt->execute([$name]);

            if ($stmt->rowCount() > 0) return false;

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return false;
        }
    }

    public function create(array $data): bool
    {

        if (! $this->check()) return false;

        try {
            $query = "INSERT INTO Author(username, twitter, password) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);

            $stmt->execute(
                [
                    $data['username'],
                    $data['twitter'],
                    $data['password']
                ]
            );

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return false;
        }
    }

    public function all(): array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Author");
            $stmt->execute();

            $data = $stmt->fetchAll();

            if (! $data){
                return [];
            }

            return $data;

        } catch(\PDOException $error){
            echo $error->getMessage();

            return [];
        }
    }

    public function delete(?int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM Author WHERE id=?");
            $stmt->execute([$id]);

            return true;

        } catch(\PDOException $error){
            echo $error->getMessage();
            return false;
        }
    }

    public function checkPassword(string $password, string $username): bool
    {
        try {
            $query = "SELECT * FROM Author WHERE username=?";
            $stmt = $this->db->prepare($query);

            $stmt->execute([$username]);

            if ($stmt->fetch()['password'] !== $password) return false;

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return false;
        }
    }



    public function author(string $username): array
    {
        try {
            $query = "SELECT * FROM Author WHERE username=? OR id=?";
            $stmt = $this->db->prepare($query);

            $stmt->execute([$username, $username]);
            $data = $stmt->fetch();

            if (! $data){
                return [];
            }

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return [];
        }
    }

    public function addDemo(string $image, string $email, string $phone, string $username): bool
    {
        try {
            $query = "UPDATE Author SET image=:img, email=:email, phone=:phone WHERE username=:username";
            $stmt = $this->db->prepare($query);

            $stmt->execute(
                [
                    ':img' => $image,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':username' => $username
                ]
            );
            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return false;
        }
    }

}