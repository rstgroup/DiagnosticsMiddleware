<?php

namespace RstGroup\DiagnosticsMiddleware\Test;

use PHPUnit_Framework_TestCase;
use RstGroup\DiagnosticsMiddleware\ConfigProvider;

class ConfigProviderTest extends PHPUnit_Framework_TestCase
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
