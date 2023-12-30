<?php

namespace App\Models;

class DestroyerModel extends Model
{
    public function destroy(): bool
    {
        try {
            $stmt = $this->db->prepare("DROP DATABASE ZOLIBERRY");
            $stmt->execute();

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }

}