<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Ramsey\Uuid\Uuid;
use App\Application\Shared\Services\Logs\LoggerInterface;

class CorrelationIdMiddleware
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $correlationId = $request->header('X-Correlation-Id', Uuid::uuid4()->toString());

        $this->logger->info('[CorrelationIdMiddleware] - {correlationId} - Iniciar Middleware', [
            'correlationId' => $correlationId
        ]);

        $request->attributes->set('correlationId', $correlationId);

        $response = $next($request);
        $response->headers->set('X-Correlation-Id', $correlationId);

        $this->logger->info('[CorrelationIdMiddleware] - {correlationId} - Finalizar Middleware', [
            'correlationId' => $correlationId
        ]);

        return $response;
    }
}
