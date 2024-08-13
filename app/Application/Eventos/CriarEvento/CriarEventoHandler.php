<?php

namespace App\Application\Eventos\CriarEvento;

use App\Domain\Eventos\EventoRepositoryInterface;
use App\Domain\Auditorias\AuditoriaRepositoryInterface;
use App\Application\Shared\Services\Logs\LoggerInterface;
use App\Application\Shared\Services\UnitOfWork\UnitOfWorkInterface;

class CriarEventoHandler
{
    private readonly EventoRepositoryInterface $eventoRepository;
    private readonly AuditoriaRepositoryInterface $auditoriaRepository;
    private readonly LoggerInterface $logger;
    private readonly UnitOfWorkInterface $uow;

    public function __construct(
        EventoRepositoryInterface $eventoRepository,
        AuditoriaRepositoryInterface $auditoriaRepository,
        UnitOfWorkInterface $uow,
        LoggerInterface $logger)
    {
        $this->eventoRepository = $eventoRepository;
        $this->auditoriaRepository = $auditoriaRepository;
        $this->logger = $logger;
        $this->uow = $uow;
    }

    public function executar(CriarEventoRequest $request): CriarEventoResponse
    {
        $this->logger->info('[CriarEventoHandler][executar] - {correlationId} - Iniciar criação de evento', [
            'correlationId' => $request->correlationId
        ]);

        $evento = CriarEventoMapper::toDomain($request);
        $auditoria = CriarEventoMapper::toAudit($evento);

        $this->uow->beginTransaction();

        $evento = $this->eventoRepository->criar($evento);
        $this->auditoriaRepository->criar($auditoria);

        $this->logger->info('[CriarEventoHandler][executar] - {correlationId} - Finalizar criação de evento identificador {identificador}', [
            'correlationId' => $request->correlationId,
            'identificador' => $evento->identificador
        ]);

        $this->uow->commit();

        return CriarEventoMapper::toResponse($evento);
    }
}
