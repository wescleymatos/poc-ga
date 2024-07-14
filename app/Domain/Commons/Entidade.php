<?php

namespace App\Domain\Commons;

use Ramsey\Uuid\Uuid;
use DateTime;

abstract class Entidade
{
    public int $id;
    public string $identificador;
    public DateTime $dataCriacao;
    public ?DateTime $dataAtualizacao;

    public function __construct()
    {
        $this->dataCriacao = new DateTime();
        $this->identificador = Uuid::uuid4()->toString();
    }
}
