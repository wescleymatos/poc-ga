<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Eventos\CriarEvento\CriarEventoHandler;
use App\Application\Eventos\CriarEvento\CriarEventoRequest;
use App\Application\Shared\Services\Logs\LoggerInterface;

class EventoController extends Controller
{
    private readonly CriarEventoHandler $handler;
    private readonly LoggerInterface $logger;

    public function __construct(CriarEventoHandler $handler, LoggerInterface $logger)
    {
        $this->handler = $handler;
        $this->logger = $logger;
    }

    public function criar(Request $request)
    {
        $correlationId = $request->attributes->get('correlationId');

        $this->logger->info('[EventoController] - {correlationId} - Iniciar criação de evento', [
            'correlationId' => $correlationId
        ]);

        $request = new CriarEventoRequest(
            $correlationId,
            $request->input('nome'),
            $request->input('descricao'),
            $request->input('dataEvento'));

        $response = $this->handler->executar($request);

        $this->logger->info('[EventoController] - {correlationId} - Finalizar criação de evento', [
            'correlationId' => $correlationId
        ]);

        return response()->json($response);
    }
}
