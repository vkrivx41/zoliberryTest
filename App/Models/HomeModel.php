<?php

namespace App\Models;

use DateTime;

class HomeModel extends Model
{
    public function today(int $start, int $end): array
    {
        $today = (new DateTime('today'))->format("Y-m-d");

        try {
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE created_at=? ORDER BY views DESC LIMIT ?, ?");
            $stmt->execute([$today, $start, $end]);

            $data = $stmt->fetchAll();

            if (! $data) return [];

            if (count($data) < 3){
                $data = $this->fetchPreviously($start, $end);
            }
            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return  [];
        }
    }

    public function fetchPreviously(int $start, int $end): array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Article ORDER BY created_at DESC, views DESC LIMIT ?, ?");
            $stmt->execute([$start, $end]);

            $data = $stmt->fetchAll();

            if (! $data) return [];

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return  [];
        }
    }


    public function topStories(int $limit)
    {
        $today = (new DateTime('today'))->format("Y-m-d");

        try {
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE created_at=? ORDER BY views DESC LIMIT ?");

            $stmt->execute([$today, $limit]);

            $data = $stmt->fetchAll();

            if (! $data) return [];

            return $data;
        } catch (\PDOException $error){
            echo $error->getMessage();

            return  [];
        }
    }

    public function search(string $pattern): array
    {
        try {
            $query = "SELECT * FROM Article WHERE title LIKE ? ORDER BY created_at DESC, views DESC LIMIT 4";

            $stmt = $this->db->prepare($query);

            $stmt->execute(
                [
                    '%'.$pattern."%",
                ]
            );

            $data = $stmt->fetchAll();

            if (! $data) return [];

            return $data;
        } catch (\PDOException $error){
            echo $error->getMessage();

            return  [];
        }
    }

}