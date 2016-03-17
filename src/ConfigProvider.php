<?php

namespace RstGroup\DiagnosticsMiddleware;

final class ConfigProvider
{
    public function __invoke()
    {
        return [
            'rstgroup' => [
                'diagnostics-middleware' => [
                    'checks' => [],
                ],
            ],
            'dependencies' => [
                'factories' => [
                    DiagnosticsListMiddleware::class => DiagnosticsListMiddlewareFactory::class,
                    DiagnosticsListMiddlewareFactory::LIST_SERVICE_NAME => DiagnosticsListFactory::class,
                    RunnerFactory::CHECKS_SERVICE_NAME => RunnerChecksFactory::class,
                    ZendDiagnostics\Runner\Runner::class => RunnerFactory::class,
                ],
                'invokables' => [
                    ResultResponseFactory\JsonResultResponseFactory::class => ResultResponseFactory\JsonResultResponseFactory::class,
                ],
            ],
        ];
    }
}