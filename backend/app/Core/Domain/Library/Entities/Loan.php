<?php

// app/Core/Domain/Loan.php
namespace App\Core\Domain;

class Loan {
    private $id;
    private $bookId;
    private $authorId;
    private $userId;
    private $loanDate;
    private $returnDate;
    private $status;  // Exemplo: Pendente, Devolvido

    public function __construct($bookId, $authorId, $userId, $loanDate, $returnDate, $status) {
        $this->bookId = $bookId;
        $this->authorId = $authorId;
        $this->userId = $userId;
        $this->loanDate = $loanDate;
        $this->returnDate = $returnDate;
        $this->status = $status;
    }

    // Getters e setters para os atributos
}
