<?php

namespace App\Models;

use App\Initiator;
use App\DB;

class Model
{
    public DB $db;
    public function __construct()
    {
        $this->db = Initiator::db();
    }

    public function manager(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM Manager WHERE 1");
        $stmt->execute();

        return $stmt->fetch();
    }
}