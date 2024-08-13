<?php

namespace App\Infra\Data\UnitOfWork;

use App\Application\Shared\Services\UnitOfWork\UnitOfWorkInterface;
use Illuminate\Database\DatabaseManager;

class UnitOfWork implements UnitOfWorkInterface
{
    private $db;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    public function beginTransaction(): void
    {
        $this->db->beginTransaction();
    }

    public function commit(): void
    {
        $this->db->commit();
    }

    public function rollback(): void
    {
        $this->db->rollBack();
    }
}
