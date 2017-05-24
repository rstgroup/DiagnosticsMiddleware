<?php

namespace RstGroup\DiagnosticsMiddleware;

use Psr\Container\ContainerInterface;

final class DiagnosticsListFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $checksService = $container->get('config')['rstgroup']['diagnostics_middleware']['checks'];
        $checkService = [];

        foreach ($checksService as $group => $checks) {
            foreach ($checks as $check => $serviceName) {
                $checkService[$group][] = $check;
            }
        }
        return $checkService;
    }
}
