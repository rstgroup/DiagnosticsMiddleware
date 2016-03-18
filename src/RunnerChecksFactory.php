<?php

namespace RstGroup\DiagnosticsMiddleware;

use Interop\Container\ContainerInterface;

final class RunnerChecksFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $checksService = $container->get('config')['rstgroup']['diagnostics_middleware']['checks'];
        $checkService = [];

        foreach ($checksService as $group => $checks) {
            foreach ($checks as $check => $serviceName) {
                $checkService[sprintf('%s/%s', $group, $check)] = $container->get($serviceName);
            }
        }
        return $checkService;
    }
}