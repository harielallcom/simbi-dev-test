<?php

namespace App\Core\Domain\Library\Exceptions;

use Exception;

class AuthorNotFoundException extends Exception
{
    protected $message = 'Author not found';

    /**
     * Construtor opcional para personalizar a mensagem.
     *
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
