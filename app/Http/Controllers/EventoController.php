<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Eventos\CriarEvento\CriarEventoHandler;
use App\Application\Eventos\CriarEvento\CriarEventoRequest;

class EventoController extends Controller
{
    private CriarEventoHandler $handler;

    public function __construct(CriarEventoHandler $handler)
    {
        $this->handler = $handler;
    }

    public function criar(Request $request)
    {
        $criarEventoRequest = new CriarEventoRequest(
            $request->input('nome'),
            $request->input('descricao'),
            $request->input('dataEvento'));

        $response = $this->handler->executar($criarEventoRequest);

        return response()->json($response);
    }
}
