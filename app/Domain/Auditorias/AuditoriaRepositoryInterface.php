<?php

namespace App\Domain\Auditorias;

interface AuditoriaRepositoryInterface
{
    public function criar(Auditoria $auditoria): void;
}
