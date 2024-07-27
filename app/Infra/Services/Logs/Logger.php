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
        $evento = $this->criarEvento(LogLevel::INFO, $message, $context);

        $this->enviarEvento($evento);
    }

    public function warning(string $message, $contexto = []): void
    {
        $evento = $this->criarEvento(LogLevel::WARNING, $message, $contexto);

        $this->enviarEvento($evento);
    }

    public function error(string $message, $contexto = [], $ex = ""): void
    {
        $evento = $this->criarEvento(LogLevel::ERROR, $message, $contexto, $ex);

        $this->enviarEvento($evento);
    }

    private function enviarEvento(string $evento): void
    {
        $this->client->post($this->url, [
            "headers" => [
                "Content-Type" => "application/json",
                "X-Seq-ApiKey" => getenv("SEQ_API_KEY")
            ],
            "body" => $evento
        ]);
    }

    private function criarEvento($nivel, $mensagem, $contexto = [], $ex = ""): string
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
}
