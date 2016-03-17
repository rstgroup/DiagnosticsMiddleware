<?php

namespace RstGroup\DiagnosticsMiddleware;

final class ConfigProvider
{
    public function __invoke()
    {
        return require __DIR__ .'/../config/config.php';
    }
}