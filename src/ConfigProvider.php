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
        ];
    }
}