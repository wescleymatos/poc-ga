<?php

namespace Tests\Unit\Domain\Eventos;

use PHPUnit\Framework\TestCase;
use App\Domain\Eventos\Cnpj;
use InvalidArgumentException;

class CnpjTest extends TestCase
{
    public function test_if_when_pass_valid_cnpj_without_dot_should_be_return_true(): void
    {
        // arrange
        $value = '75468323000103';

        // act
        $cnpj = new Cnpj($value);

        // assert
        $this->assertEquals('75.468.323/0001-03', $cnpj->value);
    }

    public function test_if_when_pass_valid_cnpj_with_dot_should_be_return_true(): void
    {
        // arrange
        $value = '12.345.678/0001-95';

        // act
        $cnpj = new Cnpj($value);

        // assert
        $this->assertEquals('12.345.678/0001-95', $cnpj->value);
    }

    public function test_when_pass_invalid_cnpj_throw_exception(): void
    {
        // assert
        $this->expectException(InvalidArgumentException::class);

        // arrange
        $value = '12.345.678/0001-96';

        // act
        $cnpj = new Cnpj($value);

    }

    public function test_when_pass_lenght_invalid_cnpj_throw_exception(): void
    {
        // assert
        $this->expectException(InvalidArgumentException::class);

        // arrange
        $value = '123456780001';

        // act
        $cnpj = new Cnpj($value);

    }

    public function test_when_pass_all_same_numbers_cnpj_throw_exception(): void
    {
        // assert
        $this->expectException(InvalidArgumentException::class);

        // arrange
        $value = '11.111.111/1111-11';

        // act
        $cnpj = new Cnpj($value);

    }
}
