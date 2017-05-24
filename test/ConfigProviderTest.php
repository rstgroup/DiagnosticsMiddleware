<?php

namespace RstGroup\DiagnosticsMiddleware\Test;

use PHPUnit\Framework\TestCase;
use RstGroup\DiagnosticsMiddleware\ConfigProvider;

class ConfigProviderTest extends TestCase
{
    protected $provider;


    protected function setUp()
    {
        $this->provider = new ConfigProvider();
    }

    public function testConfigProviderReturnArray()
    {
        $result = call_user_func($this->provider);

        $this->assertTrue(is_array($result));
    }
}
