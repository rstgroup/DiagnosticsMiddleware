<?php

namespace RstGroup\DiagnosticsMiddleware\Test;

use Psr\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use RstGroup\DiagnosticsMiddleware\DiagnosticsListFactory;

class DiagnosticsListFactoryTest extends TestCase
{
    protected $factory;
    protected $container;

    protected function setUp()
    {
        $this->factory = new DiagnosticsListFactory();
        $this->container = $this->createMock(ContainerInterface::class);
    }

    public function testCreateList()
    {
        $this->container->method('get')->with('config')->willReturn([
            'rstgroup' => [
                'diagnostics_middleware' => [
                    'checks' => [
                        'group' => [
                            'my-check' => 'service-name',
                            'my-second-check' => 'other-service-name',
                        ]
                    ],
                ],
            ],
        ]);

        $result = call_user_func($this->factory, $this->container);

        $expected = [
            'group' => [
                'my-check',
                'my-second-check',
            ],
        ];

        $this->assertSame($expected, $result);
    }
}
