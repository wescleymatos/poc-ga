<?php

namespace App\Domain\Eventos;

use Ramsey\Uuid\Uuid;

class Evento
{
    public readonly int $id;
    public readonly string $identificador;
    public readonly string $nome;
    public readonly string $descricao;
    public readonly string $dataEvento;

    public function __construct()
    { }

    public static function new(string $nome, string $descricao, string $dataEvento): self
    {
        $entidade = new self();
        $entidade->identificador = Uuid::uuid4()->toString();
        $entidade->nome = $nome;
        $entidade->descricao = $descricao;
        $entidade->dataEvento = $dataEvento;

        return $entidade;
    }

    public static function fromArray(array $data): self
    {
        $entidade = new self();
        $entidade->id = $data['id'];
        $entidade->identificador = $data['identificador'];
        $entidade->nome = $data['nome'];
        $entidade->descricao = $data['descricao'];
        $entidade->dataEvento = $data['data_evento'];

        return $entidade;
    }
}
