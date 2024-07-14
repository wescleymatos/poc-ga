<?php

namespace App\Application\Eventos\CriarEvento;

use App\Domain\Eventos\EventoRepositoryInterface;
use App\Domain\Eventos\Evento;

class CriarEventoHandler
{
    private EventoRepositoryInterface $eventoRepository;

    public function __construct(EventoRepositoryInterface $eventoRepository)
    {
        $this->eventoRepository = $eventoRepository;
    }

    public function executar(CriarEventoRequest $request): CriarEventoResponse
    {
        $evento = Evento::new(
            $request->nome,
            $request->descricao,
            $request->dataEvento
        );

        $evento = $this->eventoRepository->criar($evento);

        return new CriarEventoResponse(
            $evento->id,
            $evento->identificador,
            $evento->nome,
            $evento->descricao,
            $evento->dataEvento
        );
    }
}
