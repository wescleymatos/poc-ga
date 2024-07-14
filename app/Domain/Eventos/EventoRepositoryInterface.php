<?php

namespace App\Domain\Eventos;

interface EventoRepositoryInterface
{
    //public function buscar(): array;
    public function buscarPorId(int $id): ?Evento;
    public function criar(Evento $evento): Evento;
    public function atualizar(Evento $evento): void;
    public function deletar(int $id): void;
}
