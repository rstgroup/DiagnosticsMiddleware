<?php

namespace RstGroup\DiagnosticsMiddleware\ResultResponseFactory;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use ZendDiagnostics\Result\Collection;

interface ResultResponseFactoryInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param Collection $resultCollection
     *
     * @return ResponseInterface
     */
    public function createResponse(ServerRequestInterface $request, Collection $resultCollection);
}