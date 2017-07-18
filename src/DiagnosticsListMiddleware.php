<?php

namespace RstGroup\DiagnosticsMiddleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use PhpMiddleware\DoublePassCompatibilityTrait;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

final class DiagnosticsListMiddleware implements MiddlewareInterface
{
    use DoublePassCompatibilityTrait;

    /**
     * @var array
     */
    private $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new JsonResponse($this->list);
    }
}
