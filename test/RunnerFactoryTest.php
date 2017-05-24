<?php

namespace RstGroup\DiagnosticsMiddleware\Test;

use Psr\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use RstGroup\DiagnosticsMiddleware\RunnerFactory;
use ZendDiagnostics\Runner\Runner;

class RunnerFactoryTest extends TestCase
{
    public function testGetInstance()
    {
        $factory = new RunnerFactory();

        $container = $this->createMock(ContainerInterface::class);

        $runner = $factory($container);

        $this->assertInstanceOf(Runner::class, $runner);
    }
}
