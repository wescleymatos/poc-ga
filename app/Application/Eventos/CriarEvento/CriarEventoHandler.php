<?php

namespace App\Application\Eventos\CriarEvento;

use App\Domain\Eventos\EventoRepositoryInterface;
use App\Domain\Eventos\Evento;
use App\Application\Shared\Services\Logs\LoggerInterface;

class CriarEventoHandler
{
    private readonly EventoRepositoryInterface $eventoRepository;
    private readonly LoggerInterface $logger;

    public function __construct(EventoRepositoryInterface $eventoRepository, LoggerInterface $logger)
    {
        $this->eventoRepository = $eventoRepository;
        $this->logger = $logger;
    }

    public function executar(CriarEventoRequest $request): CriarEventoResponse
    {
        $this->logger->info('[CriarEventoHandler][executar] - {correlationId} - Iniciar criação de evento', [
            'correlationId' => $request->correlationId
        ]);

        $evento = Evento::new(
            $request->nome,
            $request->descricao,
            $request->dataEvento
        );

        $evento = $this->eventoRepository->criar($evento);

        $this->logger->info('[CriarEventoHandler][executar] - {correlationId} - Finalizar criação de evento identificador {identificador}', [
            'correlationId' => $request->correlationId,
            'identificador' => $evento->identificador
        ]);

        return new CriarEventoResponse(
            $evento->id,
            $evento->identificador,
            $evento->nome,
            $evento->descricao,
            $evento->dataEvento
        );
    }
}
