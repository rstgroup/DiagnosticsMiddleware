<?php

namespace RstGroup\DiagnosticsMiddleware\Test;

use PHPUnit_Framework_TestCase;
use Psr\Http\Message\ResponseInterface;
use RstGroup\DiagnosticsMiddleware\DiagnosticsMiddleware;
use RstGroup\DiagnosticsMiddleware\ResultResponseFactory\ResultResponseFactoryInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use ZendDiagnostics\Result\Collection;
use ZendDiagnostics\Runner\Runner;

class DiagnosticsMiddlewareTest extends PHPUnit_Framework_TestCase
{
    protected $middleware;
    protected $runner;
    protected $resultResponseFactory;
    protected $request;
    protected $response;
    protected $collection;

    protected function setUp()
    {
        $this->collection = new Collection();
        $this->request = new ServerRequest();
        $this->response = new Response();
        $this->runner = $this->getMock(Runner::class);
        $this->resultResponseFactory = $this->getMock(ResultResponseFactoryInterface::class);

        $this->middleware = new DiagnosticsMiddleware($this->runner, $this->resultResponseFactory);
    }

    public function testInvoke()
    {
        $this->runner->method('run')->willReturn($this->collection);

        $this->resultResponseFactory->method('createResponse')->willReturn($this->response);

        $finalResponse = $this->middleware->__invoke($this->request, $this->response);

        $this->assertInstanceOf(ResponseInterface::class, $finalResponse);
    }

    public function testInvokeUsingRunner()
    {
        $this->runner->method('run')->willReturn($this->collection);

        $responseFromFactory = new Response();
        $responseFromFactory->getBody()->write('foo');

        $this->resultResponseFactory->method('createResponse')->with($this->request, $this->collection)->willReturn($responseFromFactory);

        $finalResponse = $this->middleware->__invoke($this->request, $this->response);

        $this->assertSame($responseFromFactory, $finalResponse);
    }

    public function testRunSingleCheck()
    {
        $this->runner->method('run')->with('group-name/label-name')->willReturn($this->collection);

        $this->request = $this->request->withQueryParams(['filter' => 'group-name', 'label' => 'label-name']);

        $responseFromFactory = new Response();
        $responseFromFactory->getBody()->write('foo');

        $this->resultResponseFactory->method('createResponse')->with($this->request, $this->collection)->willReturn($responseFromFactory);

        $finalResponse = $this->middleware->__invoke($this->request, $this->response);

        $this->assertSame($responseFromFactory, $finalResponse);
    }
}