<?php

namespace App\Domain\Auditorias;

use App\Domain\Commons\Entidade;

class Auditoria extends Entidade
{
    public readonly string $casoDeUso;
    public readonly string $conteudo;
    public readonly string $identificadorUsuario;
    public readonly string $identificadorEntidade;

    public function __construct()
    {
        parent::__construct();
    }

    public static function new(string $casoDeUso, string $conteudo, string $identificadorEntidade, string $identificadorUsuario): self
    {
        $entidade = new self();
        $entidade->casoDeUso = $casoDeUso;
        $entidade->conteudo = $conteudo;
        $entidade->identificadorUsuario = $identificadorUsuario;
        $entidade->identificadorEntidade = $identificadorEntidade;

        return $entidade;
    }

    public static function fromArray(array $data): self
    {
        $entidade = new self();
        $entidade->id = $data['id'];
        $entidade->identificador = $data['identificador'];
        $entidade->casoDeUso = $data['caso_de_uso'];
        $entidade->conteudo = $data['conteudo'];
        $entidade->identificadorUsuario = $data['identificador_usuario'];
        $entidade->identificadorEntidade = $data['identificador_entidade'];

        return $entidade;
    }
}
