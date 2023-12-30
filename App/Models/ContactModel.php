<?php

    namespace App\Models;


    class ContactModel extends Model
    {
        public function store(array $info): bool
        {
            try {
                $query = "INSERT INTO messages(sender_email, sender_telephone, sender_name, body) VALUES (?, ?, ?, ?)";
                $stmt = $this->db->prepare($query);

                $stmt->execute(
                    [
                        $info['email'],
                        $info['phone'],
                        $info['names'],
                        $info['message'],
                    ]
                );

                return true;
    
            } catch(\PDOException $error){
                echo $error->getMessage();
    
                return false;
            }
        }


        public function all(): array
        {
            try {
                $query = "SELECT * FROM Messages ORDER BY sent DESC, sender_name ASC";
                $stmt = $this->db->prepare($query);

                $stmt->execute();

                return $stmt->fetchAll();
    
            } catch(\PDOException $error){
                echo $error->getMessage();
    
                return [];
            }
        }

        public function delete(string|int $id): bool
        {
            try {
                $query = "DELETE FROM Messages WHERE id =?";
                $stmt = $this->db->prepare($query);

                $stmt->execute(
                    [
                        $id
                    ]
                );

                return true;
    
            } catch(\PDOException $error){
                echo $error->getMessage();
    
                return false;
            }
        }
    }