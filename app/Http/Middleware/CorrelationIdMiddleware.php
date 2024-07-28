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
        $traceId = bin2hex(random_bytes(8));
        $spanId = bin2hex(random_bytes(8));

        $this->logger->trace($traceId, 'trace start {traceId}', [
            'traceId' => $traceId
        ]);

        $this->logger->span($traceId, $spanId, "Span {spanId} ended within trace {traceId}.",  ['traceId' => $traceId, 'spanId' => $spanId, '@tr' => $traceId, '@sp' => $spanId]);

        $request->attributes->set('correlationId', $correlationId);

        $response = $next($request);
        $response->headers->set('X-Correlation-Id', $correlationId);

        $this->logger->span($traceId, $spanId, "Span {spanId} started within trace {traceId}.",  ['traceId' => $traceId, 'spanId' => $spanId, '@tr' => $traceId, '@sp' => $spanId]);
        //$this->logger->span($traceId, $spanId, '[CorrelationIdMiddleware] - span');

        $this->logger->trace($traceId, 'trace end {traceId}', [
            'traceId' => $traceId
        ]);

        return $response;
    }
}
