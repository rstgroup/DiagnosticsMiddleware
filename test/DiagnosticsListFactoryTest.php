<?php

namespace RstGroup\DiagnosticsMiddleware\Test;

use PHPUnit_Framework_TestCase;

class DiagnosticsListFactoryTest extends PHPUnit_Framework_TestCase
{
    protected $factory;
    protected $container;

    protected function setUp()
    {
        $this->factory = new \RstGroup\DiagnosticsMiddleware\DiagnosticsListFactory();
        $this->container = $this->getMock(\Interop\Container\ContainerInterface::class);
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
