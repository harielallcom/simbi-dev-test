<?php

namespace App\Core\Domain\Library\Exceptions;

use Exception;

class InvalidLoanDataException extends Exception
{
    public function __construct(string $message = "Dados inválidos fornecidos para o empréstimo.")
    {
        parent::__construct($message);
    }
}
