<?php

    namespace App;
    
    use App\Services\EmailService;
    use App\Services\InvoiceService;
    use App\Services\PaddlePayment;
    use App\Services\PaymentGatewayService;
    use App\Services\PaymentGatewayServiceInterface;
    use App\Services\SalesTaxService;
    use App\Services\StripePayment;
    use PhpParser\Node\Stmt\Continue_;

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

            $this->container->set(PaymentGatewayServiceInterface::class, StripePayment::class);
        }

        public static function db(): DB
        {
            return static::$db;
        }
        public function run()
        {
            try {
                echo $this->router->resolve(
                    strtolower($this->request['method']),
                    $this->request['uri']
                );
            } catch (RouterNotFoundExceptions) {
                http_response_code(404);
            }
        }
    }