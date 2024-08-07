<?php

namespace App\Application\Shared\Services\Logs;

interface LoggerInterface
{
    public function info(string $message, $contexto = []): void;
    public function warning(string $message, $contexto = []): void;
    public function error(string $message, $contexto = [], $ex = ""): void;
    public function trace(string $id, string $message, $contexto = []): void;
    public function span(string $id, string $spanId, string $message, $contexto = []): void;
}
