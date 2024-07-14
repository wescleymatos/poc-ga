<?php

namespace App\Application\Eventos\CriarEvento;

class CriarEventoResponse
{
    public function __construct(
        public readonly int $id,
        public readonly string $identificador,
        public readonly string $nome,
        public readonly string $descricao,
        public readonly string $dataEvento)
    { }
}
