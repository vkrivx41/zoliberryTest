<?php

namespace App\Models;

class UserModel extends Model
{
    public function setTheme(string $theme, int $id): bool
    {
        try {
            $query = "UPDATE Users SET theme = ? WHERE id=?";
            $stmt = $this->db->prepare($query);

            $stmt->execute(
                [$theme, $id]
            );

            return true;
        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }

    public function create(): bool
    {
        try {
            $query = "INSERT INTO Users (created_at, theme) VALUES (default, default)";
            $stmt = $this->db->prepare($query);

            $stmt->execute();

            return true;
        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }

    public function getLastId(): int
    {
        try {
            return (int) $this->db->lastInsertId();

        } catch (\PDOException $error){
            echo $error->getMessage().$error->getFile();

            return 0;
        }
    }

    public function getTheme(int $id=null): string
    {
        try {
            $query = "SELECT * FROM Users WHERE id =?";
            $stmt = $this->db->prepare($query);

            $stmt->execute(
                [$id]
            );

            $data = $stmt->fetch();

            if (! $data){
                return "white";
            }

            return $data['theme'];

        } catch (\PDOException $error){
            echo $error->getMessage().$error->getFile();

            return "";
        }
    }
}