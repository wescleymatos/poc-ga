<?php

namespace App\Domain\Eventos;

enum StatusEvento: string
{
    case AGUARDANDO = 'AGUARDANDO';
    case ANDAMENTO = 'ANDAMENTO';
    case REALIZADO = 'REALIZADO';
    case CANCELADO = 'CANCELADO';
}
