<?php

namespace App\Application\Shared\Bases;

class BaseRequest
{
    public function __construct(
        public string $correlationId)
    { }
}
