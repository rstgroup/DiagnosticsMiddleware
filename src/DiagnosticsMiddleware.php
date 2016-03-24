<?php

namespace RstGroup\DiagnosticsMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RstGroup\DiagnosticsMiddleware\ResultResponseFactory\ResultResponseFactoryInterface;
use ZendDiagnostics\Runner\Runner;

final class DiagnosticsMiddleware
{
    /**
     * @var Runner
     */
    private $runner;

    /**
     * @var ResultResponseFactoryInterface
     */
    private $resultResponseFactory;

    public function __construct(Runner $runner, ResultResponseFactoryInterface $resultResponseFactory)
    {
        $this->runner = $runner;
        $this->resultResponseFactory = $resultResponseFactory;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $checkName = null;
        $queryParams = $request->getQueryParams();

        if (!empty($queryParams['filter']) && !empty($queryParams['label'])) {
            $checkName = sprintf('%s/%s', $queryParams['filter'], $queryParams['label']);
        }

        if ($checkName === null && !empty($request->getAttribute('filter')) && !empty($request->getAttribute('label'))) {
            $checkName = sprintf('%s/%s', $request->getAttribute('filter'), $request->getAttribute('label'));
        }

        $resultCollection = $this->runner->run($checkName);

        return $this->resultResponseFactory->createResponse($request, $resultCollection);
    }
}