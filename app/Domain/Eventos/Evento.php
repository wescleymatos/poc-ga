<?php

namespace App\Domain\Eventos;

use Ramsey\Uuid\Uuid;
use App\Domain\Commons\Entidade;

class Evento extends Entidade
{
    //public readonly int $id;
    //public readonly string $identificador;
    public readonly string $nome;
    public readonly string $descricao;
    public readonly string $dataEvento;

    // TODO: Adicionar propriedades
    public readonly string $quantidadeVagas;
    public readonly string $observacao;
    public readonly string $dataInicio;
    public readonly string $dataFim;
    public readonly string $nomeEmpresa;
    public readonly string $razaoSocialEmpresa;
    public readonly Cnpj $cnpjEmpresa;
    public readonly StatusEvento $status;
    //

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
