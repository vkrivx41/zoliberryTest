<?php

namespace App\Models;

use DateTime;

class NewModel extends Model
{
    public function today(string $table, int $start, int $end): array
    {
        $today = (new DateTime('today'))->format("Y-m-d");

        try {
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE created_at=? AND tag=? ORDER BY views DESC LIMIT ?, ?");
            $stmt->execute([$today, $table, $start, $end]);

            $data = $stmt->fetchAll();

            if (! $data) return [];

            return $data;
        } catch (\PDOException $error){
            echo $error->getMessage();

            return  [];
        }
    }


    public function top(string $table, int $limit): array
    {
        $today = (new DateTime('today'))->format("Y-m-d");

        try {
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE created_at=? AND tag=? ORDER BY views DESC LIMIT ?");

            $stmt->execute([$today, $table, $limit]);

            $data = $stmt->fetchAll();

            if (! $data) return [];

            return $data;
        } catch (\PDOException $error){
            echo $error->getMessage();

            return  [];
        }
    }

    public function fetchPreviously(string $tag, int $start, int $end)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE tag=? ORDER BY created_at DESC, views DESC LIMIT ?, ?");
            $stmt->execute([$tag, $start, $end]);

            $data = $stmt->fetchAll();

            if (! $data) return [];

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return  [];
        }
    }
}