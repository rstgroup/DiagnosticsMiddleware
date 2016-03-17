<?php

return [
    'rstgroup' => [
        'diagnostics-middleware' => [
            'checks' => [],
        ],
    ],
    'dependencies' => [
        'factories' => [
            RstGroup\DiagnosticsMiddleware\DiagnosticsListMiddleware::class => RstGroup\DiagnosticsMiddleware\DiagnosticsListMiddlewareFactory::class,
            RstGroup\DiagnosticsMiddleware\DiagnosticsListMiddlewareFactory::LIST_SERVICE_NAME => RstGroup\DiagnosticsMiddleware\DiagnosticsListFactory::class,
            RstGroup\DiagnosticsMiddleware\RunnerFactory::CHECKS_SERVICE_NAME => RstGroup\DiagnosticsMiddleware\RunnerChecksFactory::class,
            ZendDiagnostics\Runner\Runner::class => RstGroup\DiagnosticsMiddleware\RunnerFactory::class,
        ],
        'invokables' => [
            RstGroup\DiagnosticsMiddleware\ResultResponseFactory\JsonResultResponseFactory::class => RstGroup\DiagnosticsMiddleware\ResultResponseFactory\JsonResultResponseFactory::class,
        ],
    ],
];
