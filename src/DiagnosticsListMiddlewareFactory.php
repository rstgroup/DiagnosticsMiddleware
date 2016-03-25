<?php

namespace RstGroup\DiagnosticsMiddleware;

use Interop\Container\ContainerInterface;

/**
 * @codeCoverageIgnore
 */
class DiagnosticsListMiddlewareFactory
{
    const LIST_SERVICE_NAME = 'rstgroup_diagnosticsmiddleware_diagnosticslistmiddlewarefactory_list';

    public function __invoke(ContainerInterface $container)
    {
        $list = $container->get(self::LIST_SERVICE_NAME);

        return new DiagnosticsListMiddleware($list);
    }
}
