<?php

namespace App\Application\Eventos\CriarEvento;

class CriarEventoRequest
{
    public function __construct(
        public readonly string $nome,
        public readonly string $descricao,
        public readonly string $dataEvento)
    { }
}
