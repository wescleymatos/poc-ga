<?php

namespace App\Domain\Eventos;

use InvalidArgumentException;

final class Cnpj
{
    public readonly string $value;

    public function __construct(string $cnpj)
    {
        if (empty($cnpj) || $cnpj === null) {
            throw new InvalidArgumentException('CNPJ é obrigatório.');
        }

        if (!$this->isValid($cnpj)) {
            throw new InvalidArgumentException('CNPJ inválido.');
        }

        $this->value = $this->format($cnpj);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function isValid(string $cnpj): bool
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verifica se todos os dígitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Valida os dois dígitos verificadores
        for ($t = 12; $t < 14; $t++) {
            $d = 0;
            $c = 0;
            for ($m = $t - 7; $c < $t; $c++, $m--) {
                $m = ($m < 2) ? 9 : $m;
                $d += $cnpj[$c] * $m;
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cnpj[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    private function format(string $cnpj): string
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        return preg_replace(
            '/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/',
            '$1.$2.$3/$4-$5',
            $cnpj
        );
    }
}
