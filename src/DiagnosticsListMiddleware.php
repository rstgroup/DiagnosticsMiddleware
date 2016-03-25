<?php

namespace RstGroup\DiagnosticsMiddleware;

use Zend\Diactoros\Response\JsonResponse;

final class DiagnosticsListMiddleware
{
    /**
     * @var array
     */
    private $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        return new JsonResponse($this->list);
    }
}
