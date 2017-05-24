<?php

namespace RstGroup\DiagnosticsMiddleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use PhpMiddleware\DoublePassCompatibilityTrait;
use Psr\Http\Message\ServerRequestInterface;
use RstGroup\DiagnosticsMiddleware\ResultResponseFactory\ResultResponseFactoryInterface;
use ZendDiagnostics\Runner\Runner;

final class DiagnosticsMiddleware implements MiddlewareInterface
{
    use DoublePassCompatibilityTrait;

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

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
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
