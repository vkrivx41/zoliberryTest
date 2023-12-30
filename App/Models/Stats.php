<?php

namespace App\Models;

class Stats extends Model
{

    public function all(string $start_date, string $end_date): array
    {
        try {
            $query = "SELECT au.username, SUM(ar.views) as 'views', COUNT(*) as 'articles' FROM Author au  INNER JOIN Article ar ON ar.author = au.username OR ar.author = au.email WHERE created_at BETWEEN ? AND ? GROUP BY au.username ORDER BY `views` DESC, `articles` DESC, au.username ASC;";
            $stmt = $this->db->prepare($query);
            $stmt->execute(
                [
                    $start_date, $end_date
                ]
            );

            $data = $stmt->fetchAll();

            if (! $data){
                return [];
            }

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return [];
        }
    }

    public function authorStatus(string $id, string $start, string $end)
    {
        try {
            $query = "SELECT * FROM Article WHERE author = :username OR author = :email AND created_at BETWEEN :start AND :end ORDER BY created_at DESC LIMIT 3";
            $stmt = $this->db->prepare($query);
            $stmt->execute(
                [
                    ':username' => $id,
                    ':email' => $id,
                    ':start' => $start,
                    ':end' => $end
                ]
            );

            $data = $stmt->fetchAll();

            if (! $data){
                return [];
            }

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return [];
        }
    }

    public function moderators(string $start_date, string $end_date)
    {
        try {
            $query = "SELECT mo.username, SUM(ar.views) as 'views', COUNT(*) as 'articles' FROM Moderator mo LEFT JOIN Article ar ON ar.author = mo.username OR ar.author = mo.email WHERE created_at BETWEEN ? AND ? GROUP BY mo.username ORDER BY `views` DESC, `articles` DESC, mo.username ASC;";
            $stmt = $this->db->prepare($query);
            $stmt->execute(
                [
                    $start_date, $end_date
                ]
            );

            $data = $stmt->fetchAll();

            if (! $data){
                return [];
            }

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return [];
        }
    }

    public function moderatorsStats(string $id, string $start, string $end)
    {
        try {
            $query = "SELECT SUM(ar.views) as 'views', COUNT(*) as 'articles' FROM Moderator au  INNER JOIN Article ar ON ar.author = au.username OR ar.author = au.email WHERE au.username = :username OR au.email = :email AND created_at BETWEEN :start AND :end GROUP BY au.username ORDER BY `views` DESC, `articles` DESC, au.username ASC;";
            $stmt = $this->db->prepare($query);
            $stmt->execute(
                [
                    ':username' => $id,
                    ':email' => $id,
                    ':start' => $start,
                    ':end' => $end
                ]
            );

            $data = $stmt->fetchAll();

            if (! $data){
                return [];
            }

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();
            return [];
        }
    }
}
