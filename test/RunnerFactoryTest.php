<?php

namespace RstGroup\DiagnosticsMiddleware\Test;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use RstGroup\DiagnosticsMiddleware\RunnerFactory;
use ZendDiagnostics\Runner\Runner;

class RunnerFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testGetInstance()
    {
        $factory = new RunnerFactory();

        $container = $this->getMock(ContainerInterface::class);

        $runner = $factory($container);

        $this->assertInstanceOf(Runner::class, $runner);
    }
}