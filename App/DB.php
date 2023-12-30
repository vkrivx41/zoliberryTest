<?php

    namespace App;
    use mysql_xdevapi\DatabaseObject;
    use PDO;

    class DB
    {
        private string|PDO $pdo = DatabaseObject::class;

        public function __construct(protected array $config)
        {
            $defaultOptions = [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            
            try {
                $this->pdo = new PDO(
                $this->config['engine'].":host=".$this->config['host'].";dbname=". $this->config['name'],
                $this->config['user'],
                $this->config['password'],
                $this->config['options'] ?? $defaultOptions
            );
            } catch (\PDOException $error) {
                echo $error;
                echo "Can't connect to the website right now, try again later.";
            }
        }

        // this method is creates so that if pdo methods or functions are called upon this class -- DB class which doesn't contain those methods the call is redirected to the methods of the PDO instance or $this->pdo
        public function __call(string $name, array $arguments)
        {
            return call_user_func_array([$this->pdo, $name], $arguments) ?? "";
        }
    }