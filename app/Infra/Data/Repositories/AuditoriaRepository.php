<?php

namespace App\Infra\Data\Repositories;

use App\Domain\Auditorias\Auditoria;
use App\Domain\Auditorias\AuditoriaRepositoryInterface;
use App\Infra\Data\Models\AuditoriaModel;

class AuditoriaRepository implements AuditoriaRepositoryInterface
{
    public function criar(Auditoria $auditoria): void
    {
        $model = new AuditoriaModel();
        $model->identificador = $auditoria->identificador;
        $model->caso_de_uso = $auditoria->casoDeUso;
        $model->conteudo = $auditoria->conteudo;
        $model->identificador_usuario = $auditoria->identificadorUsuario;
        $model->identificador_entidade = $auditoria->identificadorEntidade;
        $model->save();
    }
}
