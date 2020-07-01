<?php

namespace App;

use Psr\Http\Message\ResponseInterface;

class HelloWorld
{
    private $foo;
    private $response;

    public function __construct(String $foo, ResponseInterface $response)
    {
        $this->foo = $foo;
        $this->response = $response;
    }

    public function __invoke(): ResponseInterface
    {
        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()
            ->write("<html><head></head><body>Hello, {$this->foo} world!</body></html>");

        return $response;
    }
}
