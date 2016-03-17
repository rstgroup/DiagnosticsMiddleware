<?php

namespace RstGroup\DiagnosticsMiddleware\ResultResponseFactory;

use ArrayObject;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use ZendDiagnostics\Result\Collection;
use ZendDiagnostics\Result\FailureInterface;
use ZendDiagnostics\Result\ResultInterface;
use ZendDiagnostics\Result\SuccessInterface;
use ZendDiagnostics\Result\WarningInterface;

final class JsonResultResponseFactory implements ResultResponseFactoryInterface
{
    public function createResponse(ServerRequestInterface $request, Collection $resultCollection)
    {
        $data = [
            'details' => $this->getDetails($resultCollection),
            'success' => $resultCollection->getSuccessCount(),
            'warning' => $resultCollection->getWarningCount(),
            'failure' => $resultCollection->getFailureCount(),
            'skip' => $resultCollection->getSkipCount(),
            'unknown' => $resultCollection->getUnknownCount(),
            'passed' => $resultCollection->getFailureCount() === 0,
        ];

        return new Response\JsonResponse($data);
    }

    private function getDetails(Collection $resultCollection)
    {
        $details = new ArrayObject();

        foreach ($resultCollection as $item) {
            $result = $resultCollection[$item];
            $details[$item->getLabel()] = [
                'result' => $this->getResultName($result),
                'message' => $result->getMessage(),
                'data' => $result->getData(),
            ];
        }
        return $details;
    }

    private function getResultName(ResultInterface $result)
    {
        switch (true) {
            case $result instanceof SuccessInterface:
                return 'success';
            case $result instanceof WarningInterface:
                return 'warning';
            case $result instanceof FailureInterface:
                return 'failure';
            case $result instanceof ResultInterface:
                return 'skip';
            default:
                return 'unknown';
        }
    }
}