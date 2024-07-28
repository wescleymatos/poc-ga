<?php

namespace App\Infra\Services\Logs;

use App\Application\Shared\Services\Logs\LoggerInterface;
use DateTimeImmutable;
use GuzzleHttp\Client;

class Logger implements LoggerInterface
{
    private readonly Client $client;
    private readonly string $url;

    public function __construct()
    {
        $this->client = new Client();
        $this->url = getenv("SEQ_BASE_URI");
    }

    public function info(string $message, $context = []): void
    {
        $payload = $this->criarLogPayload(LogLevel::INFO, $message, $context);

        $this->enviar($payload);
    }

    public function warning(string $message, $contexto = []): void
    {
        $payload = $this->criarLogPayload(LogLevel::WARNING, $message, $contexto);

        $this->enviar($payload);
    }

    public function error(string $message, $contexto = [], $ex = ""): void
    {
        $payload = $this->criarLogPayload(LogLevel::ERROR, $message, $contexto, $ex);

        $this->enviar($payload);
    }

    public function trace(string $id, string $message, $contexto = []): void
    {
        $payload = $this->criarTracePayload($id, $message, $contexto);

        $this->enviar($payload);
    }

    public function span(string $id, $spanId, string $message, $contexto = []): void
    {
        $payload = $this->criarSpanPayload($id, $spanId, $message, $contexto);

        $this->enviar($payload);
    }

    private function enviar(string $payload): void
    {
        $this->client->post($this->url, [
            "headers" => [
                "Content-Type" => "application/json",
                "X-Seq-ApiKey" => getenv("SEQ_API_KEY")
            ],
            "body" => $payload
        ]);
    }

    private function criarLogPayload($nivel, $mensagem, $contexto = [], $ex = ""): string
    {
        $evento =  [
            "@t" => (new DateTimeImmutable())->format("c"),
            "@l" => $nivel,
            "@mt" => $mensagem,
            "@x" => $ex,
            ...$contexto
        ];

        return json_encode($evento, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    private function criarTracePayload($id, $mensagem, $contexto = []): string
    {
        $evento =  [
            "@sc" => "poc-ga",
            "@tr" => $id,
            "@t" => (new DateTimeImmutable())->format("c"),
            "@l" => LogLevel::TRACE,
            "@mt" => $mensagem,
            ...$contexto
        ];

        return json_encode($evento, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    private function criarSpanPayload($id, $spanId, $mensagem, $contexto = []): string
    {
        $evento =  [
            "@tr" => $id,
            "@sp" => $spanId,
            "@st" => (new DateTimeImmutable())->format("c"),
            "@t" => (new DateTimeImmutable())->format("c"),
            "@l" => LogLevel::TRACE,
            "@mt" => $mensagem,
            ...$contexto
        ];

        return json_encode($evento, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
