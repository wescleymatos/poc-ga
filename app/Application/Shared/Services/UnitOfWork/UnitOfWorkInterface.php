<?php

namespace App\Application\Shared\Services\UnitOfWork;

interface UnitOfWorkInterface
{
    public function beginTransaction(): void;
    public function commit(): void;
    public function rollback(): void;
}
