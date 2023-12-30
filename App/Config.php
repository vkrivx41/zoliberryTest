<?php

    namespace App;

    class Config
    {
        private array $config = [];
        public function __construct(array $env)
        {
            $this->config = [
                'db' => [
                    'host' => $env['DB_HOST'] ?? "localhost",
                    'user' => $env['DB_USER'] ?? "root",
                    'password' => $env['DB_PASSWORD'] ?? "",
                    'name' => $env['DB_NAME'] ?? "zolibery",
                    'engine' => $env['DB_ENGINE'] ?? "mysql",
                ],
                'article' =>[
                    'title' => $env['TITLE_COUNT'] ?? 500,
                    'para' => $env['PARA_COUNT'] ?? 2000
                ]
            ];
        }

        public function __get(string $name)
        {
            return $this->config[$name] ?? null;
        }
    }