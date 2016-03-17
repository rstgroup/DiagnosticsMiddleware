<?php

namespace RstGroup\DiagnosticsMiddleware\Test\ResultResponseFactory;

use PHPUnit_Framework_TestCase;
use Psr\Http\Message\ResponseInterface;
use RstGroup\DiagnosticsMiddleware\ResultResponseFactory\JsonResultResponseFactory;
use Zend\Diactoros\ServerRequest;
use ZendDiagnostics\Check\CheckInterface;
use ZendDiagnostics\Result\Collection;
use ZendDiagnostics\Result\Failure;
use ZendDiagnostics\Result\Success;

class JsonResultResponseFactoryTest extends PHPUnit_Framework_TestCase
{
    protected $resultResponseFactory;

    protected function setUp()
    {
        $this->resultResponseFactory = new JsonResultResponseFactory();
    }

    public function testReturnResponse()
    {
        $response = $this->resultResponseFactory->createResponse(new ServerRequest(), new Collection());

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testJsonContentType()
    {
        $response = $this->resultResponseFactory->createResponse(new ServerRequest(), new Collection());

        $this->assertSame('application/json', $response->getHeaderLine('Content-type'));
    }

    public function testReturnEmptyCollection()
    {
        $response = $this->resultResponseFactory->createResponse(new ServerRequest(), new Collection());

        $expectedJson = '{"details":{},"success":0,"warning":0,"failure":0,"skip":0,"unknown":0,"passed":true}';

        $this->assertSame($expectedJson, (string) $response->getBody());
    }

    public function testReturnFilledPassedCollection()
    {
        $collection = new Collection();
        $check = $this->getMock(CheckInterface::class);
        $check->method('getLabel')->willReturn('Foo');

        $collection[$check] = new Success('Boo');

        $response = $this->resultResponseFactory->createResponse(new ServerRequest(), $collection);

        $expectedJson = '{"details":{"Foo":{"result":"success","message":"Boo","data":null}},"success":1,"warning":0,"failure":0,"skip":0,"unknown":0,"passed":true}';

        $this->assertSame($expectedJson, (string) $response->getBody());
    }

    public function testReturnFilledPassedAndFailureCollection()
    {
        $collection = new Collection();
        $checkPass = $this->getMock(CheckInterface::class);
        $checkPass->method('getLabel')->willReturn('Foo');

        $checkFailure = $this->getMock(CheckInterface::class);
        $checkFailure->method('getLabel')->willReturn('Baz');

        $collection[$checkPass] = new Success('Boo');
        $collection[$checkFailure] = new Failure('Bar', [1=>2]);

        $response = $this->resultResponseFactory->createResponse(new ServerRequest(), $collection);

        $expectedJson = '{"details":{"Foo":{"result":"success","message":"Boo","data":null},"Baz":{"result":"failure","message":"Bar","data":{"1":2}}},"success":1,"warning":0,"failure":1,"skip":0,"unknown":0,"passed":false}';

        $this->assertSame($expectedJson, (string) $response->getBody());
    }
}
