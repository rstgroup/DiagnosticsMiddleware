<?php

namespace RstGroup\DiagnosticsMiddleware\Test;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RstGroup\DiagnosticsMiddleware\DiagnosticsListMiddleware;

class DiagnosticsListMiddlewareTest extends TestCase
{
    public function testGetList()
    {
        $list = ['boo' => 'foo'];
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $next = function (){};

        $middleware = new DiagnosticsListMiddleware($list);

        $response = $middleware($request, $response, $next);

        $this->assertSame('application/json', $response->getHeaderLine('Content-type'));
        $this->assertSame('{"boo":"foo"}', (string) $response->getBody());
    }
}
