<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use OpenTelemetry\API\Globals;
// use OpenTelemetry\API\Common\Instrumentation\Globals;
use OpenTelemetry\SDK\Common\Export\Http\PsrTransportFactory;
use OpenTelemetry\SDK\Trace\TracerProvider;
use OpenTelemetry\SDK\Trace\SpanProcessor\BatchSpanProcessor;
use OpenTelemetry\SDK\Trace\Exporter\ZipkinExporter;
use OpenTelemetry\SDK\Trace\Sampler\AlwaysOnSampler;

class TraceMiddleware
{
    public function __construct()
    {
        // $transport = (new PsrTransportFactory(,))->create('http://localhost:9411/api/v2/spans');
        // $exporter = new ZipkinExporter($transport);

        // $tracerProvider = new TracerProvider(
        //     new BatchSpanProcessor($exporter),
        //     new AlwaysOnSampler()
        // );

        // Globals::setTracerProvider($tracerProvider);

        $tracer = Globals::tracerProvider()->getTracer('demo');
    }

    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
