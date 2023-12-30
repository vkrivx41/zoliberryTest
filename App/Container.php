<?php

    namespace App;

    use App\Exceptions\ContainerException;

    use Psr\Container\ContainerExceptionInterface;
    use Psr\Container\ContainerInterface;
    use Psr\Container\NotFoundExceptionInterface;
    use ReflectionException;

    class Container implements ContainerInterface
    {
        private array $entries = [];

        /**
         * @throws NotFoundExceptionInterface
         * @throws ContainerExceptionInterface
         * @throws ReflectionException
         * @throws ContainerException
         */
        public function get(string $id)
        {
            if($this->has($id)){
                $entry = $this->entries[$id];

                if (is_callable($entry)) return $entry($this);

                $id = $entry; // this is the same as return " $this->resolve($id) " but we prevent code duplication
            }
            return $this->resolve($id);
        }
        public function has(string $id): bool
        {
            return isset($this->entries[$id]);
        }

        public function set(string $id, callable|string $concrete): void
        {
            $this->entries[$id] = $concrete;
        }

        /**
         * @throws NotFoundExceptionInterface
         * @throws ContainerExceptionInterface
         * @throws ContainerException
         * @throws ReflectionException
         */
        public function resolve(string $id)
        {
            // 1. Inspect the class that we are trying to get from the container
            $reflectionClass = new \ReflectionClass($id);

            if(! $reflectionClass->isInstantiable()){
                throw new ContainerException('Class "'. $id .'" is not instantiable');
            }

            // 2. Inspect the constructor of the class
            $constructor = $reflectionClass->getConstructor();

            if(! $constructor){
                return new $id;
            }

            // 3. Inspect the constructor parameter (dependencies)
            $parameters = $constructor->getParameters();

            if(! $parameters){
                return $reflectionClass->newInstance(); // the sames as << return new $id >>
            }

            // 4. If the constructor parameter is a class then resolve it again using the container (recursively)
            $dependencies = array_map(
                function(\ReflectionParameter $param) use ($id) {
                    $type = $param->getType();

                    if(! $type){
                        throw new ContainerException('Failed to solve class "'. $id. '" because param "'. $param. '" does n\'t have a type hint.');
                    }

                    if($type instanceof \ReflectionUnionType){
                        throw new ContainerException('Failed to solve class "'. $id. '" because of union type for param "'. $param);
                    }

                    if($type instanceof \ReflectionNamedType && ! $type->isBuiltIn()){
                        return $this->get($type->getName());
                    }

                    throw new ContainerException('Failed to solve class "'. $id. '" because of invalid param "'. $param);
                },
            $parameters);
            
            return $reflectionClass->newInstanceArgs($dependencies);
        }

    }