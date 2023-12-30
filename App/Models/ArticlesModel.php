<?php

namespace App\Models;

class ArticlesModel extends Model
{
    private array $ids = [];

    public function randomIdCreator(): int
    {
        $id = mt_rand(1, 1000000000);

        if (array_search($id, $this->ids)){
            return $this->randomIdCreator();
        }

        return $id;
    }

    public function create(array $data): bool
    {
        try {
            $query = "INSERT INTO Article (tag, title, one_text, two_text, three_text, four_text, five_text,  author) VALUES (:tag, :title, :one_text, :two_text, :three_text, :four_text, :five_text, :author)";
            $stmt = $this->db->prepare($query);
            $stmt->execute(
                [
                    ':tag' => $data['category'],
                    ':title' => $data['title'],
                    ':one_text' => $data['paragraph_one'],
                    ':two_text' => $data['paragraph_two'],
                    ':three_text' => $data['paragraph_three'],
                    ':four_text' => $data['paragraph_four'],
                    ':five_text' => $data['paragraph_five'],
                    ':author' => $data['author']
                ]
            );

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }

    public function uploadImages(array $data, string $id=null): bool
    {
        try {
            $query = "UPDATE Article SET one_image=:one, two_image=:two, three_image=:three, four_image=:four, five_image=:five WHERE id=:id";
            $stmt = $this->db->prepare($query);

            $arr = [];

            foreach ($data as $values){
                foreach ($values as $key => $value){
                    $arr[$key] = $value;
                }
            }

            if($id == null){
                $id = $this->getLastId();
            }

            $stmt->execute(
                [
                    ':one' => $arr['image_one'] ?? null,
                    ':two' => $arr['image_two'] ?? null,
                    ':three' => $arr['image_three'] ?? null,
                    ':four' => $arr['image_four'] ?? null,
                    ':five' => $arr['image_five'] ?? null,
                    'id' => $id
                ]
            );

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }

    private function getLastId(): int|null
    {
        try {
            return (int) $this->db->lastInsertId();
        } catch (\PDOException $error){
            echo $error->getMessage();

            return null;
        }
    }

    public function all(int $limit): array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE 1 ORDER BY created_at DESC LIMIT ?");
            $stmt->execute([$limit]);

            $data = $stmt->fetchAll();

            if (! $data) return [];

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return [];
        }
    }

    public function usernameOrEmail(string $usernameOrEmail): array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM dashboard WHERE username=? OR email=?");
            $stmt->execute([$usernameOrEmail, $usernameOrEmail]);

            $data = $stmt->fetch();
            if (! $data) return [];

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return [];
        }
    }

    public function images(?string $id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE id=?");
            $stmt->execute([$id]);

            $data = $stmt->fetch();

            if (! $data) return [];

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return [];
        }
    }

    public function delete(int|string $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM Article WHERE id=?");
            $stmt->execute([$id]);

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }

    public function article(int $id, bool $returnOnly=false): array
    {
        try {

            $this->db->beginTransaction();

            if(! $returnOnly){
                $stmt = $this->db->prepare("UPDATE Article SET views=views + 1 WHERE id=?");
                $stmt->execute([$id]);
            }
           
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE id=?");
            $stmt->execute([$id]);

            $data = $stmt->fetch();

            if (! $data) return [];

            $this->db->commit();

            return $data;

        } catch (\PDOException $error){
            echo $error->getMessage();
            if ($this->db->inTransaction()){
                $this->db->rollback();
            }
            return [];
        }
    }

    public function checkIfModerator(string $usernameOrEmail): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Moderator WHERE username=? OR email=?");
            $stmt->execute([$usernameOrEmail, $usernameOrEmail]);

            if ($stmt->rowCount() == 0){
                return false;
            }

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }

    public function checkIfAuthor(string $usernameOrEmail): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Author WHERE username=? OR email=?");
            $stmt->execute([$usernameOrEmail, $usernameOrEmail]);

            if ($stmt->rowCount() === 0){
                return false;
            }

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }

    public function popular(): array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Article ORDER BY views DESC, created_at DESC LIMIT 5");
            $stmt->execute();

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

    public function checkLimit(string $category): bool
    {
        $date = (new \DateTime('today'))->format("Y-m-d");

        try {
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE tag=? and created_at=?");
            $stmt->execute([$category, $date]);

            if ($stmt->rowCount() >= $_ENV['ARTICLES_DAILY_LIMIT']){
                return false;
            }

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }

    public function search(string $pattern): array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE title LIKE :pattern");
            $stmt->execute(
                [
                    ':pattern' => '%'.$pattern.'%'
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

    public function check_if_article_exist(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Article WHERE id = ?");
            $stmt->execute(
                [
                    $id
                ]
            );
      
            if ($stmt->rowCount() == 0){
                return false;
            }

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }


    public function update_texts(array $data, int $id): bool
    {
        try {
            $query = "UPDATE Article SET tag=:tag, title=:title, one_text=:one_text, two_text=:two_text, three_text=:three_text, four_text=:four_text, five_text=:five_text WHERE id=:id";

            $stmt = $this->db->prepare($query);
            $stmt->execute(
                [
                    ':id' => $id,
                    ':tag' => $data['category'],
                    ':title' => $data['title'],
                    ':one_text' => $data['paragraph_one'],
                    ':two_text' => $data['paragraph_two'],
                    ':three_text' => $data['paragraph_three'],
                    ':four_text' => $data['paragraph_four'],
                    ':five_text' => $data['paragraph_five']
                ]
            );

            return true;

        } catch (\PDOException $error){
            echo $error->getMessage();

            return false;
        }
    }
}
