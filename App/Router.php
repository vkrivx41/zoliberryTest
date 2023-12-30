<?php

    namespace App;

    use App\Controllers\PageNotFoundController;
    use App\Attributes\Route;
    use App\Exceptions\RouterNotFoundException;
    use Psr\Container\ContainerExceptionInterface;
    use Psr\Container\NotFoundExceptionInterface;

    class Router
    {
        private array $routers = [];

        public function __construct(
            protected Container $container
        ){

        }
        
        public function register(string $requestMethod, string $requestUri, array|callable $action): void
        {
            $this->routers[$requestMethod][strtolower($requestUri)] = $action;
        }

        /**
         * @throws \ReflectionException
         */
        public function registerRoutesFromControllerAttributes(array $controllers): void
        {
            foreach ($controllers as $controller) {
                $reflectionController = new \ReflectionClass($controller);

                foreach ($reflectionController->getMethods() as $method){
                    $attributes = $method->getAttributes(Route::class, \ReflectionAttribute::IS_INSTANCEOF);

                    foreach ($attributes as $attribute){
                        $route = $attribute->newInstance(); // new $attribute() -- can't work bcs construct is private

                        $this->register($route->method, strtolower($route->path), [$controller, $method->getName()]);
                    }
                }
            }
        }

        public function get(string $requestUri, array|callable $action): self
        {
            $this->register("get", $requestUri, $action);
            return $this;
        }

        public function post(string $requestUri, array|callable $action): self
        {
            $this->register("post", $requestUri, $action);
            return $this;
        }
        public function routes(): array
        {
            return $this->routers;
        }

        /**
         * @throws ContainerExceptionInterface
         * @throws NotFoundExceptionInterface
         * @throws RouterNotFoundException
         * @throws \ReflectionException
         */
        public function resolve(string $requestMethod, string $requestUri)
        {
            $requestUri = strtolower(explode('?', $requestUri)[0]);

            $route = $this->routers[$requestMethod][$requestUri] ?? null;

            if(! $route){
                $class = $this->container->get(PageNotFoundController::class);


                return call_user_func_array([$class, "index"], []);
            }

            if(is_callable($route)){
                return call_user_func($route);
            }

            if(is_array($route)){
                [$class, $method] = $route;

                if(class_exists($class)){
                    $class = $this->container->get($class);

                    if(method_exists($class, $method) ){
                        return call_user_func_array([$class, $method], []);
                    }
                }
            }

            throw new RouterNotFoundException();
        }
    }