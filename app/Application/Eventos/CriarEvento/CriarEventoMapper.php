<?php

namespace App\Application\Eventos\CriarEvento;

use App\Domain\Auditorias\Auditoria;
use App\Domain\Eventos\Evento;

class CriarEventoMapper
{
    const AUDITORIA_CASO_DE_USO = "CriarEvento";

    public static function toDomain(CriarEventoRequest $data): Evento
    {
        return Evento::new(
            $data->nome,
            $data->descricao,
            $data->dataEvento
        );
    }

    public static function toAudit(Evento $data): Auditoria
    {
        return Auditoria::new(
            self::AUDITORIA_CASO_DE_USO,
            json_encode($data),
            $data->identificador,
            "system"
        );
    }

    public static function toResponse(Evento $data): CriarEventoResponse
    {
        return new CriarEventoResponse(
            $data->id,
            $data->identificador,
            $data->nome,
            $data->descricao,
            $data->dataEvento
        );
    }
}
