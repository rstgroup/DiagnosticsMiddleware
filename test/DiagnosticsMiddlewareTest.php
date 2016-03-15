<?php

namespace RstGroup\DiagnosticsMiddleware\Test;

use PHPUnit_Framework_TestCase;
use Psr\Http\Message\ResponseInterface;
use RstGroup\DiagnosticsMiddleware\DiagnosticsMiddleware;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class DiagnosticsMiddlewareTest extends PHPUnit_Framework_TestCase
{
    protected $middleware;

    protected function setUp()
    {
        $this->middleware = new DiagnosticsMiddleware();
    }

    public function testInvoke()
    {
        $request = new ServerRequest();

        $response = new Response();

        $finalResponse = $this->middleware->__invoke($request, $response);

        $this->assertInstanceOf(ResponseInterface::class, $finalResponse);
    }
}