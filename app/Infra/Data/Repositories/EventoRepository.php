<?php

namespace App\Infra\Data\Repositories;

use App\Domain\Eventos\EventoRepositoryInterface;
use App\Domain\Eventos\Evento;
use App\Infra\Data\Models\EventoModel;

class EventoRepository implements EventoRepositoryInterface
{
    public function buscarPorId(int $id): ?Evento
    {
        return EventoModel::find($id);
    }

    public function criar(Evento $evento): Evento
    {
        $model = new EventoModel();
        $model->nome = $evento->nome;
        $model->identificador = $evento->identificador;
        $model->descricao = $evento->descricao;
        $model->data_evento = $evento->dataEvento;
        $model->save();

        return Evento::fromArray($model->toArray());
    }

    public function atualizar(Evento $evento): void
    {
        $model = EventoModel::find($evento->id);
        $model->nome = $evento->nome;
        $model->descricao = $evento->descricao;
        $model->data_evento = $evento->dataEvento;
        $model->save();
    }

    public function deletar(int $id): void
    {
        EventoModel::destroy($id);
    }
}
