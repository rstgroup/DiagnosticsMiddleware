<?php

namespace RstGroup\DiagnosticsMiddleware;

use Interop\Container\ContainerInterface;
use ZendDiagnostics\Runner\Runner;

final class RunnerFactory
{
    const CONFIG_SERVICE_NAME = 'rstgroup_diagnosticsmiddleware_service_config';
    const CHECKS_SERVICE_NAME = 'rstgroup_diagnosticsmiddleware_service_checks';
    const REPORTER_SERVICE_NAME = 'rstgroup_diagnosticsmiddleware_service_reporter';

    public function __invoke(ContainerInterface $container)
    {
        $config = $container->has(self::CONFIG_SERVICE_NAME) ? $container->get(self::CONFIG_SERVICE_NAME) : null;
        $checks = $container->has(self::CHECKS_SERVICE_NAME) ? $container->get(self::CHECKS_SERVICE_NAME) : null;
        $reporter = $container->has(self::REPORTER_SERVICE_NAME) ? $container->get(self::REPORTER_SERVICE_NAME) : null;

        return new Runner($config, $checks, $reporter);
    }
}
