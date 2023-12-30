<?php

    namespace App;
    
    use App\Exceptions\RouterNotFoundException;
    use Psr\Container\ContainerExceptionInterface;
    use Psr\Container\NotFoundExceptionInterface;

    class Initiator
    {

        private static DB $db;
        public function __construct(
            protected Container $container,
            protected Router $router,
            protected array $request,
            protected Config $config
        )
        {
            static::$db = new DB($config->db ?? []);
        }

        public static function db(): DB
        {
            return static::$db;
        }
        public function run(): void
        {
            try {
                echo $this->router->resolve(
                    strtolower($this->request['method']),
                    $this->request['uri']
                );
            } catch (RouterNotFoundException) {
                http_response_code(404);
            } catch (NotFoundExceptionInterface|ContainerExceptionInterface|\ReflectionException $e) {
                echo $e;
            }
        }
    }