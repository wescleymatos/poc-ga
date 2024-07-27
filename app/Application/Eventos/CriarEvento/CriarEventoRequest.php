<?php

namespace App\Application\Eventos\CriarEvento;

use App\Application\Shared\Bases\BaseRequest;

class CriarEventoRequest extends BaseRequest
{
    public function __construct(
        public string $correlationId,
        public readonly string $nome,
        public readonly string $descricao,
        public readonly string $dataEvento)
    {
        parent::__construct($correlationId);
    }
}
