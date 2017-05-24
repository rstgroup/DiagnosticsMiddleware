<?php

namespace RstGroup\DiagnosticsMiddleware\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\DiagnosticsMiddleware\DiagnosticsListMiddleware;

class DiagnosticsListMiddlewareTest extends TestCase
{
    public function testGetList()
    {
        $list = ['boo' => 'foo'];

        $middleware = new DiagnosticsListMiddleware($list);

        $response = $middleware();

        $this->assertSame('application/json', $response->getHeaderLine('Content-type'));
        $this->assertSame('{"boo":"foo"}', (string) $response->getBody());
    }
}
